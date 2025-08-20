import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

class WebSocketService {
    constructor() {
        this.echo = null
        this.isConnected = false
        this.listeners = new Map()
        this.reconnectAttempts = 0
        this.maxReconnectAttempts = 10
        this.reconnectDelay = 1000
        this.maxReconnectDelay = 30000 // 30 giây
        this.connectionCheckInterval = null
        this.heartbeatInterval = null
        this.lastHeartbeat = null
        this.connectionTimeout = 10000 // 10 giây timeout
        this.autoReconnect = true
        this.connectionStartTime = null

    }

    /**
     * Initialize WebSocket connection
     */
    init(token) {
        if (this.echo) {
            this.disconnect()
        }

        // Configure Pusher
        window.Pusher = Pusher

        // Debug: Log credentials
        console.log('WebSocket credentials:', {
            key: window.MIX_REVERB_APP_KEY,
            host: window.MIX_REVERB_HOST,
            port: window.MIX_REVERB_PORT,
            scheme: window.MIX_REVERB_SCHEME,
            hasKey: !!window.MIX_REVERB_APP_KEY,
            hasHost: !!window.MIX_REVERB_HOST
        })
        
        this.echo = new Echo({
            broadcaster: 'pusher', // Pusher.js connector cho Reverb backend
            key: window.MIX_REVERB_APP_KEY || '4qhu27f54vnhivpck8bk',
            cluster: 'mt1',
            forceTLS: false, // Local Reverb không cần TLS
            wsHost: window.MIX_REVERB_HOST || 'localhost',
            wsPort: window.MIX_REVERB_PORT || 8080,
            wssPort: window.MIX_REVERB_PORT || 8080,
            encrypted: false, // Local Reverb không encrypt
            disableStats: true,
            // Quan trọng: Tắt hoàn toàn Pusher.com
            enableStats: false,
            enableLogging: false,
            // Tắt Pusher.com stats
            statsHost: 'localhost',
            // Auth endpoint
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            },
            // Timeout settings
            activityTimeout: 30000,
            pongTimeout: 15000,
            maxReconnectionAttempts: this.maxReconnectAttempts,
            maxReconnectGap: this.maxReconnectDelay,
        })

        this.setupConnectionHandlers()
        this.startConnectionMonitoring()
        this.isConnected = true
        this.connectionStartTime = Date.now()
    }

    /**
     * Setup connection event handlers
     */
    setupConnectionHandlers() {
        this.echo.connector.pusher.connection.bind('connected', () => {
            console.log('WebSocket connected successfully')
            this.isConnected = true
            this.reconnectAttempts = 0
            this.lastHeartbeat = Date.now()
            this.startHeartbeat()
            
            this.dispatchConnectionEvent('connected')
        })

        this.echo.connector.pusher.connection.bind('disconnected', () => {
            console.log('WebSocket disconnected')
            this.isConnected = false
            this.stopHeartbeat()
            
            this.dispatchConnectionEvent('disconnected')
            
            // Auto reconnect
            if (this.autoReconnect) {
                console.log('Auto reconnect triggered due to disconnect...')
                this.handleReconnect()
            }
        })

        this.echo.connector.pusher.connection.bind('connecting', () => {
            console.log('WebSocket connecting...')
            this.isConnected = false
            
            // Dispatch custom event
            this.dispatchConnectionEvent('connecting')
        })

        this.echo.connector.pusher.connection.bind('error', (error) => {
            console.error('WebSocket error:', error)
            
            this.isConnected = false
            this.dispatchConnectionEvent('error', error)
            
            // Auto reconnect cho tất cả lỗi
            if (this.autoReconnect) {
                console.log('Auto reconnect triggered due to error...')
                this.handleReconnect()
            }
        })

        // Connection state change
        this.echo.connector.pusher.connection.bind('state_change', (states) => {
            console.log('WebSocket state change:', states)
            this.dispatchConnectionEvent('state_change', states)
        })
    }

    /**
     * Start connection monitoring
     */
    startConnectionMonitoring() {
        // Check connection health every 30 seconds
        this.connectionCheckInterval = setInterval(() => {
            this.checkConnectionHealth()
        }, 30000)
        
        // Monitor connection stability
        this.stabilityInterval = setInterval(() => {
            this.monitorConnectionStability()
        }, 10000) // Every 10 seconds
    }

    /**
     * Check connection health
     */
    checkConnectionHealth() {
        if (!this.echo || !this.isConnected) {
            return
        }

        const now = Date.now()
        const timeSinceLastHeartbeat = now - (this.lastHeartbeat || 0)
        
        // If no heartbeat for 45 seconds, consider connection dead
        if (timeSinceLastHeartbeat > 45000) {
            console.warn('Connection appears dead, attempting reconnection...')
            this.handleReconnect()
        }
    }
    
        /**
     * Monitor connection stability
     */
    monitorConnectionStability() {
        if (!this.echo || !this.isConnected) {
            return
        }
        
        const connectionState = this.echo.connector.pusher.connection.state
        console.log('Connection stability check:', {
            state: connectionState,
            isConnected: this.isConnected,
            timestamp: new Date().toISOString()
        })
        
        // If connection is unstable, log warning
        if (connectionState !== 'connected') {
            console.warn('Connection state unstable:', connectionState)
        }
    }
    


    /**
     * Start heartbeat monitoring
     */
    startHeartbeat() {
        this.heartbeatInterval = setInterval(() => {
            this.sendHeartbeat()
        }, 30000) // Every 30 seconds
    }

    /**
     * Stop heartbeat monitoring
     */
    stopHeartbeat() {
        if (this.heartbeatInterval) {
            clearInterval(this.heartbeatInterval)
            this.heartbeatInterval = null
        }
    }

    /**
     * Send heartbeat to server
     */
    sendHeartbeat() {
        if (this.echo && this.isConnected) {
            try {
                // Send a ping to keep connection alive
                this.echo.connector.pusher.connection.send_event('heartbeat', {
                    timestamp: Date.now(),
                    client_id: this.getClientId()
                })
                this.lastHeartbeat = Date.now()
            } catch (error) {
                console.error('Heartbeat failed:', error)
            }
        }
    }

    /**
     * Get client ID for tracking
     */
    getClientId() {
        return this.echo?.connector?.pusher?.connection?.socket_id || 'unknown'
    }

    /**
     * Handle reconnection with exponential backoff
     */
    handleReconnect() {
        if (this.reconnectAttempts >= this.maxReconnectAttempts) {
            console.error('Max reconnection attempts reached')
            this.dispatchConnectionEvent('max_reconnect_reached')
            return
        }

        this.reconnectAttempts++
        const delay = Math.min(
            this.reconnectDelay * Math.pow(2, this.reconnectAttempts - 1),
            this.maxReconnectDelay
        )

        console.log(`Attempting to reconnect... (${this.reconnectAttempts}/${this.maxReconnectAttempts}) in ${delay}ms`)
        
        setTimeout(() => {
            if (this.echo && this.autoReconnect) {
                try {
                    console.log('Reconnecting...')
                    // Force disconnect trước khi reconnect
                    this.echo.connector.pusher.disconnect()
                    
                    // Reconnect sau 1 giây
                    setTimeout(() => {
                        console.log('Attempting to connect...')
                        this.echo.connector.pusher.connect()
                    }, 1000)
                    
                } catch (error) {
                    console.error('Reconnection failed:', error)
                    this.handleReconnect() // Try again
                }
            }
        }, delay)
    }

    /**
     * Dispatch connection event to listeners
     */
    dispatchConnectionEvent(eventType, data = null) {
        const event = new CustomEvent('websocket-connection', {
            detail: {
                type: eventType,
                data: data,
                timestamp: Date.now(),
                connectionDuration: this.connectionStartTime ? Date.now() - this.connectionStartTime : 0
            }
        })
        window.dispatchEvent(event)
    }

    /**
     * Listen to shipper orders channel
     */
    listenToShipperOrders(callback) {
        if (!this.echo) {
            console.error('WebSocket not initialized')
            return
        }

        console.log('Setting up listener for shipper.orders channel')
        const channel = this.echo.channel('shipper.orders')
        
        // Listen to order status updates
        channel.listen('order.status.updated', (data) => {
            console.log('Order status updated received on shipper.orders:', data)
            callback('status_updated', data)
        })

        // Listen to new orders
        channel.listen('.order.created', (data) => {
            console.log('New order created:', data)
            callback('new_order', data)
        })

        // Listen to location updates
        channel.listen('.order.location.updated', (data) => {
            console.log('Order location updated:', data)
            callback('location_updated', data)
        })

        this.listeners.set('shipper.orders', channel)
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
        
        channel.listen('order.status.updated', (data) => {
            console.log(`Order ${orderId} status updated:`, data)
            callback('status_updated', data)
        })

        channel.listen('.order.location.updated', (data) => {
            console.log(`Order ${orderId} location updated:`, data)
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
            console.log(`Order ${orderId} location updated:`, data)
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
            channel.stopListening('.order.created')
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
        this.autoReconnect = false
        
        if (this.echo) {
            this.stopHeartbeat()
            this.stopListeningToAll()
            this.echo.disconnect()
            this.echo = null
            this.isConnected = false
        }

        if (this.connectionCheckInterval) {
            clearInterval(this.connectionCheckInterval)
            this.connectionCheckInterval = null
        }
        
        if (this.stabilityInterval) {
            clearInterval(this.stabilityInterval)
            this.stabilityInterval = null
        }

        this.dispatchConnectionEvent('disconnected')
    }

    /**
     * Get connection status
     */
    getConnectionStatus() {
        return {
            isConnected: this.isConnected,
            reconnectAttempts: this.reconnectAttempts,
            maxReconnectAttempts: this.maxReconnectAttempts,
            connectionDuration: this.connectionStartTime ? Date.now() - this.connectionStartTime : 0,
            lastHeartbeat: this.lastHeartbeat,
            clientId: this.getClientId()
        }
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

    /**
     * Enable/disable auto reconnection
     */
    setAutoReconnect(enabled) {
        this.autoReconnect = enabled
        console.log(`Auto reconnection ${enabled ? 'enabled' : 'disabled'}`)
    }

    /**
     * Force reconnection
     */
    forceReconnect() {
        if (this.echo) {
            console.log('Forcing reconnection...')
            this.echo.connector.pusher.disconnect()
            this.handleReconnect()
        }
    }
}

// Create singleton instance
const webSocketService = new WebSocketService()

export default webSocketService
