import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

class ClientWebSocketService {
    constructor() {
        this.echo = null
        this.isConnected = false
        this.listeners = new Map()
        this.reconnectAttempts = 0
        this.maxReconnectAttempts = 5
        this.reconnectDelay = 1000
    }

    /**
     * Initialize WebSocket connection
     */
    init(token, userId) {
        if (this.echo) {
            this.disconnect()
        }

        // Configure Pusher
        window.Pusher = Pusher

        this.echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY || 'your-pusher-key',
            cluster: process.env.MIX_PUSHER_APP_CLUSTER || 'mt1',
            forceTLS: true,
            auth: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'Authorization': `Bearer ${token}`,
                },
            },
        })

        this.setupConnectionHandlers()
        this.isConnected = true
        this.userId = userId
    }

    /**
     * Setup connection event handlers
     */
    setupConnectionHandlers() {
        this.echo.connector.pusher.connection.bind('connected', () => {
            console.log('Client WebSocket connected')
            this.isConnected = true
            this.reconnectAttempts = 0
        })

        this.echo.connector.pusher.connection.bind('disconnected', () => {
            console.log('Client WebSocket disconnected')
            this.isConnected = false
        })

        this.echo.connector.pusher.connection.bind('error', (error) => {
            console.error('Client WebSocket error:', error)
            this.handleReconnect()
        })
    }

    /**
     * Handle reconnection
     */
    handleReconnect() {
        if (this.reconnectAttempts < this.maxReconnectAttempts) {
            this.reconnectAttempts++
            console.log(`Attempting to reconnect... (${this.reconnectAttempts}/${this.maxReconnectAttempts})`)
            
            setTimeout(() => {
                if (this.echo) {
                    this.echo.connector.pusher.connect()
                }
            }, this.reconnectDelay * this.reconnectAttempts)
        } else {
            console.error('Max reconnection attempts reached')
        }
    }

    /**
     * Listen to client orders channel for timeline updates
     */
    listenToClientOrders(callback) {
        if (!this.echo || !this.userId) {
            console.error('WebSocket not initialized or userId not set')
            return
        }

        const channel = this.echo.private(`client.orders.${this.userId}`)
        
        // Listen to order status updates
        channel.listen('.order.status.updated', (data) => {
            console.log('Order status updated (Client):', data)
            callback('status_updated', data)
        })

        // Listen to location updates
        channel.listen('.order.location.updated', (data) => {
            console.log('Order location updated (Client):', data)
            callback('location_updated', data)
        })

        this.listeners.set(`client.orders.${this.userId}`, channel)
    }

    /**
     * Listen to specific order channel
     */
    listenToOrder(orderId, callback) {
        if (!this.echo) {
            console.error('WebSocket not initialized')
            return
        }

        const channel = this.echo.channel(`orders.${orderId}`)
        
        channel.listen('.order.status.updated', (data) => {
            console.log(`Order ${orderId} status updated (Client):`, data)
            callback('status_updated', data)
        })

        channel.listen('.order.location.updated', (data) => {
            console.log(`Order ${orderId} location updated (Client):`, data)
            callback('location_updated', data)
        })

        this.listeners.set(`orders.${orderId}`, channel)
    }

    /**
     * Listen to order location updates
     */
    listenToOrderLocation(orderId, callback) {
        if (!this.echo) {
            console.error('WebSocket not initialized')
            return
        }

        const channel = this.echo.channel(`orders.${orderId}.location`)
        
        channel.listen('.order.location.updated', (data) => {
            console.log(`Order ${orderId} location updated (Client):`, data)
            callback(data)
        })

        this.listeners.set(`orders.${orderId}.location`, channel)
    }

    /**
     * Stop listening to a specific channel
     */
    stopListening(channelName) {
        const channel = this.listeners.get(channelName)
        if (channel) {
            channel.stopListening('.order.status.updated')
            channel.stopListening('.order.location.updated')
            this.listeners.delete(channelName)
        }
    }

    /**
     * Stop listening to all channels
     */
    stopListeningToAll() {
        this.listeners.forEach((channel, channelName) => {
            this.stopListening(channelName)
        })
    }

    /**
     * Disconnect WebSocket
     */
    disconnect() {
        if (this.echo) {
            this.stopListeningToAll()
            this.echo.disconnect()
            this.echo = null
            this.isConnected = false
            this.userId = null
        }
    }

    /**
     * Get connection status
     */
    getConnectionStatus() {
        return this.isConnected
    }

    /**
     * Send message to server (if needed)
     */
    sendMessage(channel, event, data) {
        if (!this.echo || !this.isConnected) {
            console.error('WebSocket not connected')
            return false
        }

        try {
            this.echo.private(channel).whisper(event, data)
            return true
        } catch (error) {
            console.error('Error sending message:', error)
            return false
        }
    }
}

// Create singleton instance
const clientWebSocketService = new ClientWebSocketService()

export default clientWebSocketService
