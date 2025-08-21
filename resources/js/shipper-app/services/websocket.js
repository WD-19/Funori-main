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
        
        // Simple hybrid polling configuration
        this.pollingConfig = {
            enabled: true,
            baseInterval: 2000, // 5 giây
            maxInterval: 15000, // 30 giây
            currentInterval: 2000,
            consecutiveFailures: 0,
            maxFailures: 3
        }
        
        // Simple offline queue
        this.offlineQueue = []
        this.maxQueueSize = 50
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
        
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: window.MIX_REVERB_APP_KEY || '4qhu27f54vnhivpck8bk',
            cluster: 'mt1',
            forceTLS: false,
            wsHost: window.MIX_REVERB_HOST || 'localhost',
            wsPort: window.MIX_REVERB_PORT || 8080,
            wssPort: window.MIX_REVERB_PORT || 8080,
            encrypted: false,
            disableStats: true,
            enableStats: false,
            enableLogging: false,
            statsHost: 'localhost',
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            },
            activityTimeout: 30000,
            pongTimeout: 15000,
            maxReconnectionAttempts: this.maxReconnectAttempts,
            maxReconnectGap: this.maxReconnectDelay,
        })

        this.setupConnectionHandlers()
        this.startConnectionMonitoring()
        this.isConnected = true
        this.connectionStartTime = Date.now()
        
        // Start hybrid polling
        this.startHybridPolling()
    }

    /**
     * Start hybrid polling system
     */
    startHybridPolling() {
        this.pollingConfig.currentInterval = this.pollingConfig.baseInterval
        this.pollingConfig.consecutiveFailures = 0
        
        // Start polling with current interval
        this.startPolling()
    }

    /**
     * Start polling
     */
    startPolling() {
        if (this.pollingTimer) {
            clearTimeout(this.pollingTimer)
        }
        
        this.pollingTimer = setTimeout(() => {
            this.executePolling()
        }, this.pollingConfig.currentInterval)
    }

    /**
     * Execute polling with hybrid logic
     */
    async executePolling() {
        // Only poll if WebSocket is not connected or unstable
        if (this.isConnected && this.reconnectAttempts === 0) {
            // WebSocket is stable, reduce polling frequency
            this.adjustPollingInterval('success')
            this.startPolling()
            return
        }

        try {
            // Execute actual polling logic
            await this.performPolling()
            
            // Success - reduce polling frequency
            this.adjustPollingInterval('success')
        } catch (error) {
            console.error('Polling failed:', error)
            
            // Failure - increase polling frequency
            this.adjustPollingInterval('failure')
        } finally {
            // Continue polling with adjusted interval
            this.startPolling()
        }
    }

    /**
     * Perform actual polling operations
     */
    async performPolling() {
        // This method will be called by components to perform their specific polling
        return new Promise((resolve) => {
            // Default implementation - just resolve
            setTimeout(resolve, 100)
        })
    }

    /**
     * Adjust polling interval based on success/failure
     */
    adjustPollingInterval(result) {
        if (result === 'success') {
            this.pollingConfig.consecutiveFailures = 0
            
            // Gradually increase interval (backoff)
            this.pollingConfig.currentInterval = Math.min(
                this.pollingConfig.currentInterval * 1.5,
                this.pollingConfig.maxInterval
            )
        } else {
            this.pollingConfig.consecutiveFailures++
            
            // Reset to base interval on failure
            this.pollingConfig.currentInterval = this.pollingConfig.baseInterval
            
            // If too many failures, increase interval temporarily
            if (this.pollingConfig.consecutiveFailures >= this.pollingConfig.maxFailures) {
                this.pollingConfig.currentInterval = Math.min(
                    this.pollingConfig.currentInterval * 2,
                    this.pollingConfig.maxInterval
                )
            }
        }
    }

    /**
     * Add event to offline queue
     */
    addToOfflineQueue(eventType, data) {
        if (this.offlineQueue.length >= this.maxQueueSize) {
            // Remove oldest event
            this.offlineQueue.shift()
        }
        
        this.offlineQueue.push({
            type: eventType,
            data,
            timestamp: Date.now(),
            attempts: 0
        })
    }

    /**
     * Process offline queue when connection is restored
     */
    async processOfflineQueue() {
        if (this.offlineQueue.length === 0) return
        
        const eventsToProcess = [...this.offlineQueue]
        this.offlineQueue = []
        
        for (const event of eventsToProcess) {
            try {
                // Attempt to process the event
                await this.processOfflineEvent(event)
                event.attempts++
            } catch (error) {
                // Re-queue if max attempts not reached
                if (event.attempts < 3) {
                    this.offlineQueue.push(event)
                }
            }
        }
    }

    /**
     * Process a single offline event
     */
    async processOfflineEvent(event) {
        // This method should be implemented by components
        console.log('Processing offline event:', event)
        
        // Simulate processing time
        await new Promise(resolve => setTimeout(resolve, 100))
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
            
            // Process offline queue
            this.processOfflineQueue()
            
            // Reset polling to base interval
            this.pollingConfig.currentInterval = this.pollingConfig.baseInterval
            this.pollingConfig.consecutiveFailures = 0
        })

        this.echo.connector.pusher.connection.bind('disconnected', () => {
            console.log('WebSocket disconnected')
            this.isConnected = false
            this.stopHeartbeat()
            
            // Increase polling frequency when disconnected
            this.pollingConfig.currentInterval = this.pollingConfig.baseInterval
            this.pollingConfig.consecutiveFailures = 0
            
            // Auto reconnect
            if (this.autoReconnect) {
                this.handleReconnect()
            }
        })

        this.echo.connector.pusher.connection.bind('connecting', () => {
            console.log('WebSocket connecting...')
            this.isConnected = false
        })

        this.echo.connector.pusher.connection.bind('error', (error) => {
            console.error('WebSocket error:', error)
            
            this.isConnected = false
            
            // Auto reconnect cho tất cả lỗi
            if (this.autoReconnect) {
                this.handleReconnect()
            }
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
                    this.echo.connector.pusher.disconnect()
                    
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
        
        if (this.pollingTimer) {
            clearTimeout(this.pollingTimer)
            this.pollingTimer = null
        }
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
            clientId: this.getClientId(),
            pollingConfig: this.pollingConfig,
            offlineQueueSize: this.offlineQueue.length
        }
    }

    /**
     * Send message to server (if needed)
     */
    sendMessage(channel, event, data) {
        if (!this.echo || !this.isConnected) {
            // Queue message for later if offline
            this.addToOfflineQueue(event, { channel, data })
            return false
        }

        try {
            this.echo.private(channel).whisper(event, data)
            return true
        } catch (error) {
            console.error('Error sending message:', error)
            // Queue message for later
            this.addToOfflineQueue(event, { channel, data })
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

    /**
     * Set custom polling configuration
     */
    setPollingConfig(config) {
        this.pollingConfig = {
            ...this.pollingConfig,
            ...config
        }
        console.log('Polling configuration updated:', this.pollingConfig)
    }
}

// Create singleton instance
const webSocketService = new WebSocketService()

export default webSocketService
