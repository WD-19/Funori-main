<template>
  <div class="websocket-status">
    <div class="flex items-center space-x-2">
      <div :class="[
        'w-2 h-2 rounded-full',
        status === 'connected' ? 'bg-green-500' : 
        status === 'connecting' ? 'bg-yellow-500' : 'bg-red-500'
      ]"></div>
      <span :class="[
        'text-sm font-medium',
        status === 'connected' ? 'text-green-600' : 
        status === 'connecting' ? 'text-yellow-600' : 'text-red-600'
      ]">
        {{ statusText }}
      </span>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import clientWebSocketService from '../services/websocket'

const status = ref('disconnected')

const statusText = computed(() => {
  switch (status.value) {
    case 'connected':
      return 'Realtime'
    case 'connecting':
      return 'Đang kết nối'
    case 'disconnected':
      return 'Mất kết nối'
    default:
      return 'Không xác định'
  }
})

onMounted(() => {
  // Listen to WebSocket status changes
  if (clientWebSocketService.echo) {
    clientWebSocketService.echo.connector.pusher.connection.bind('connected', () => {
      status.value = 'connected'
    })
    
    clientWebSocketService.echo.connector.pusher.connection.bind('disconnected', () => {
      status.value = 'disconnected'
    })
    
    clientWebSocketService.echo.connector.pusher.connection.bind('connecting', () => {
      status.value = 'connecting'
    })
  }
})

onUnmounted(() => {
  // Cleanup if needed
})
</script>

<style scoped>
.websocket-status {
  display: inline-flex;
  align-items: center;
}
</style>
