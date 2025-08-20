<template>
  <div class="websocket-monitor bg-white rounded-lg shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-medium text-gray-900">WebSocket Monitor</h3>
      <div class="flex items-center space-x-3">
        <button 
          @click="refreshStats" 
          class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
          Refresh
        </button>
        <button 
          @click="clearLogs" 
          class="px-3 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
        >
          Clear Logs
        </button>
      </div>
    </div>

    <!-- Connection Status -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500">Connection Status</p>
            <p class="text-2xl font-semibold text-gray-900">
              {{ connectionStatus.isConnected ? 'Connected' : 'Disconnected' }}
            </p>
          </div>
          <div :class="[
            'w-3 h-3 rounded-full',
            connectionStatus.isConnected ? 'bg-green-500' : 'bg-red-500'
          ]"></div>
        </div>
      </div>

      <div class="bg-gray-50 rounded-lg p-4">
        <div>
          <p class="text-sm font-medium text-gray-500">Reconnect Attempts</p>
          <p class="text-2xl font-semibold text-gray-900">
            {{ connectionStatus.reconnectAttempts }} / {{ connectionStatus.maxReconnectAttempts }}
          </p>
        </div>
      </div>

      <div class="bg-gray-50 rounded-lg p-4">
        <div>
          <p class="text-sm font-medium text-gray-500">Connection Duration</p>
          <p class="text-2xl font-semibold text-gray-900">
            {{ formatDuration(connectionStatus.connectionDuration) }}
          </p>
        </div>
      </div>
    </div>

    <!-- Event Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-blue-50 rounded-lg p-4">
        <div class="flex items-center">
          <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-blue-600">Total Events</p>
            <p class="text-lg font-semibold text-blue-900">{{ stats.totalEvents }}</p>
          </div>
        </div>
      </div>

      <div class="bg-green-50 rounded-lg p-4">
        <div class="flex items-center">
          <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-green-600">Successful</p>
            <p class="text-lg font-semibold text-green-900">{{ stats.successfulEvents }}</p>
          </div>
        </div>
      </div>

      <div class="bg-yellow-50 rounded-lg p-4">
        <div class="flex items-center">
          <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-yellow-600">Pending</p>
            <p class="text-lg font-semibold text-yellow-900">{{ stats.pendingEvents }}</p>
          </div>
        </div>
      </div>

      <div class="bg-red-50 rounded-lg p-4">
        <div class="flex items-center">
          <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-red-600">Failed</p>
            <p class="text-lg font-semibold text-red-900">{{ stats.failedEvents }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Event Logs -->
    <div class="mb-6">
      <h4 class="text-md font-medium text-gray-900 mb-3">Recent Event Logs</h4>
      <div class="bg-gray-50 rounded-lg p-4 max-h-64 overflow-y-auto">
        <div v-if="eventLogs.length === 0" class="text-center text-gray-500 py-8">
          No event logs available
        </div>
        <div v-else class="space-y-3">
          <div 
            v-for="log in eventLogs.slice(0, 20)" 
            :key="log.id" 
            class="flex items-start space-x-3 p-3 bg-white rounded-lg border"
          >
            <div :class="[
              'w-2 h-2 rounded-full mt-2',
              log.type === 'success' ? 'bg-green-500' : 
              log.type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            ]"></div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">{{ log.event }}</p>
                <span class="text-xs text-gray-500">{{ formatTime(log.timestamp) }}</span>
              </div>
              <p class="text-sm text-gray-600 mt-1">{{ log.message }}</p>
              <div v-if="log.details" class="mt-2 text-xs text-gray-500">
                <pre class="bg-gray-100 p-2 rounded overflow-x-auto">{{ JSON.stringify(log.details, null, 2) }}</pre>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Channel Status -->
    <div>
      <h4 class="text-md font-medium text-gray-900 mb-3">Channel Status</h4>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div 
          v-for="channel in channelStatus" 
          :key="channel.name"
          class="bg-gray-50 rounded-lg p-4"
        >
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-900">{{ channel.name }}</p>
              <p class="text-xs text-gray-500">{{ channel.subscribers }} subscribers</p>
            </div>
            <div :class="[
              'w-2 h-2 rounded-full',
              channel.status === 'active' ? 'bg-green-500' : 'bg-gray-400'
            ]"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import adminWebSocketService from '../services/websocket'

const connectionStatus = ref({
  isConnected: false,
  reconnectAttempts: 0,
  maxReconnectAttempts: 10,
  connectionDuration: 0,
  lastHeartbeat: null,
  clientId: 'unknown'
})

const stats = ref({
  totalEvents: 0,
  successfulEvents: 0,
  pendingEvents: 0,
  failedEvents: 0
})

const eventLogs = ref([])
const channelStatus = ref([
  { name: 'admin.orders', status: 'active', subscribers: 0 },
  { name: 'shipper.orders', status: 'active', subscribers: 0 },
  { name: 'orders.new', status: 'active', subscribers: 0 }
])

let updateInterval = null

// Computed
const formatDuration = (ms) => {
  if (ms < 1000) return `${ms}ms`
  if (ms < 60000) return `${Math.floor(ms / 1000)}s`
  return `${Math.floor(ms / 60000)}m ${Math.floor((ms % 60000) / 1000)}s`
}

const formatTime = (timestamp) => {
  return new Date(timestamp).toLocaleTimeString()
}

// Methods
const refreshStats = () => {
  const status = adminWebSocketService.getConnectionStatus()
  connectionStatus.value = status
  
  // Update channel status
  channelStatus.value.forEach(channel => {
    channel.subscribers = Math.floor(Math.random() * 10) + 1 // Mock data
  })
}

const clearLogs = () => {
  eventLogs.value = []
}

const addEventLog = (type, event, message, details = null) => {
  const log = {
    id: Date.now() + Math.random(),
    type,
    event,
    message,
    details,
    timestamp: new Date().toISOString()
  }
  
  eventLogs.value.unshift(log)
  
  // Keep only last 100 logs
  if (eventLogs.value.length > 100) {
    eventLogs.value = eventLogs.value.slice(0, 100)
  }
  
  // Update stats
  stats.value.totalEvents++
  if (type === 'success') stats.value.successfulEvents++
  else if (type === 'error') stats.value.failedEvents++
  else stats.value.pendingEvents++
}

// Listen to WebSocket events
const setupWebSocketListeners = () => {
  window.addEventListener('websocket-connection', (event) => {
    const { type, data, timestamp, connectionDuration } = event.detail
    
    switch (type) {
      case 'connected':
        addEventLog('success', 'Connection', 'WebSocket connected successfully', {
          timestamp,
          connectionDuration
        })
        break
      case 'disconnected':
        addEventLog('error', 'Connection', 'WebSocket disconnected', {
          timestamp,
          connectionDuration
        })
        break
      case 'error':
        addEventLog('error', 'Connection Error', 'WebSocket connection error', {
          timestamp,
          error: data
        })
        break
      case 'max_reconnect_reached':
        addEventLog('error', 'Reconnection', 'Max reconnection attempts reached', {
          timestamp
        })
        break
    }
  })
}

// Lifecycle
onMounted(() => {
  setupWebSocketListeners()
  refreshStats()
  
  // Update stats every 5 seconds
  updateInterval = setInterval(() => {
    refreshStats()
  }, 5000)
})

onUnmounted(() => {
  if (updateInterval) {
    clearInterval(updateInterval)
  }
})
</script>

<style scoped>
.websocket-monitor {
  font-family: 'Inter', sans-serif;
}

pre {
  font-size: 11px;
  line-height: 1.4;
}
</style>
