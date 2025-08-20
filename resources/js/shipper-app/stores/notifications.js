import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '../services/api'

export const useNotificationStore = defineStore('notifications', () => {
  // State
  const notifications = ref([])
  const unreadCount = ref(0)


  // Computed
  const hasUnread = computed(() => unreadCount.value > 0)

  // Actions
  const fetchNotifications = async () => {
    try {
      const response = await api.get('/shipper-app/notifications')
      
      if (response.data.success) {
        notifications.value = response.data.data.notifications
        unreadCount.value = response.data.data.unread_count
      }
    } catch (error) {
      console.error('Error fetching notifications:', error)
    }
  }

  const markAsRead = async (notificationId) => {
    try {
      const response = await api.put(`/shipper-app/notifications/${notificationId}/read`)
      
      if (response.data.success) {
        // Update local state
        const notification = notifications.value.find(n => n.id === notificationId)
        if (notification) {
          notification.read_at = new Date().toISOString()
          unreadCount.value = Math.max(0, unreadCount.value - 1)
        }
      }
    } catch (error) {
      console.error('Error marking notification as read:', error)
    }
  }

  const markAllAsRead = async () => {
    try {
      const response = await api.put('/shipper-app/notifications/mark-all-read')
      
      if (response.data.success) {
        // Update local state
        notifications.value.forEach(notification => {
          if (!notification.read_at) {
            notification.read_at = new Date().toISOString()
          }
        })
        unreadCount.value = 0
      }
    } catch (error) {
      console.error('Error marking all notifications as read:', error)
    }
  }

  const deleteNotification = async (notificationId) => {
    try {
      const response = await api.delete(`/shipper-app/notifications/${notificationId}`)
      
      if (response.data.success) {
        // Remove from local state
        const index = notifications.value.findIndex(n => n.id === notificationId)
        if (index !== -1) {
          const notification = notifications.value[index]
          if (!notification.read_at) {
            unreadCount.value = Math.max(0, unreadCount.value - 1)
          }
          notifications.value.splice(index, 1)
        }
      }
    } catch (error) {
      console.error('Error deleting notification:', error)
    }
  }

  const initialize = async () => {
    try {
      // Fetch initial notifications
      await fetchNotifications()
      

      
      // Start polling as fallback
      startPolling()
    } catch (error) {
      console.error('Error initializing notifications:', error)
    }
  }

  // Fallback polling mechanism
  let pollingInterval = null

  const startPolling = () => {
    if (pollingInterval) {
      clearInterval(pollingInterval)
    }
    
    // Poll for notifications every 30 seconds
    pollingInterval = setInterval(async () => {
      if (!window.isWebSocketConnected?.value) {
        try {
          await fetchNotifications()
        } catch (error) {
          console.error('Error polling for notifications:', error)
        }
      }
    }, 30000)
  }

  const stopPolling = () => {
    if (pollingInterval) {
      clearInterval(pollingInterval)
      pollingInterval = null
    }
  }



  const requestNotificationPermission = async () => {
    if ('Notification' in window) {
      const permission = await Notification.requestPermission()
      return permission === 'granted'
    }
    return false
  }

  const cleanup = () => {
    stopPolling()
  }

  const formatTime = (time) => {
    const date = new Date(time)
    const now = new Date()
    const diffInMinutes = Math.floor((now - date) / (1000 * 60))
    
    if (diffInMinutes < 1) {
      return 'Vừa xong'
    } else if (diffInMinutes < 60) {
      return `${diffInMinutes} phút trước`
    } else if (diffInMinutes < 1440) {
      const hours = Math.floor(diffInMinutes / 60)
      return `${hours} giờ trước`
    } else {
      const days = Math.floor(diffInMinutes / 1440)
      return `${days} ngày trước`
    }
  }

  return {
    // State
    notifications,
    unreadCount,
    
    // Computed
    hasUnread,
    
    // Actions
    fetchNotifications,
    markAsRead,
    markAllAsRead,
    deleteNotification,
    initialize,
    cleanup,
    requestNotificationPermission,
    formatTime
  }
}) 