<template>
  <div id="app" class="min-h-screen bg-gray-50">
    <!-- Loading Screen -->
    <div v-if="loading" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
      <div class="text-center">
        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-4"></div>
        <p class="text-gray-600">Đang tải...</p>
      </div>
    </div>

    <!-- Main App -->
    <div v-else>
      <!-- Navigation -->
      <nav v-if="isAuthenticated" class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex items-center">
              <router-link to="/" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <span class="font-semibold text-gray-900">Shipper App</span>
              </router-link>
            </div>

            <div class="flex items-center space-x-4">
              <!-- Notifications -->
              <button @click="toggleNotifications" class="relative p-2 text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M9 11h.01M12 11h.01M15 11h.01M12 8h.01M9 8h.01M15 8h.01M12 5h.01M9 5h.01M15 5h.01M12 2h.01M9 2h.01M15 2h.01"></path>
                </svg>
                <span v-if="unreadNotifications > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {{ unreadNotifications }}
                </span>
              </button>

              <!-- Profile Menu -->
              <div class="relative">
                <button @click="toggleProfileMenu" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                  <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                    {{ userInitials }}
                  </div>
                  <span class="hidden md:block">{{ user?.name }}</span>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>

                <!-- Profile Dropdown -->
                <div v-if="showProfileMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                  <router-link to="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Hồ sơ
                  </router-link>
                  <router-link to="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Cài đặt
                  </router-link>
                  <hr class="my-1">
                  <button @click="logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    Đăng xuất
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <router-view />
      </main>

      <!-- Mobile Bottom Navigation -->
      <div v-if="isAuthenticated" class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t">
        <div class="flex justify-around py-2">
          <router-link to="/" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs mt-1">Trang chủ</span>
          </router-link>
          
          <router-link to="/orders" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="text-xs mt-1">Đơn hàng</span>
          </router-link>
          
          <router-link to="/map" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
            </svg>
            <span class="text-xs mt-1">Bản đồ</span>
          </router-link>
          
          <router-link to="/profile" class="flex flex-col items-center py-2 px-3 text-gray-600 hover:text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="text-xs mt-1">Cá nhân</span>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from './stores/auth'
import { useNotificationStore } from './stores/notifications'

// Stores
const authStore = useAuthStore()
const notificationStore = useNotificationStore()
const router = useRouter()

// Reactive data
const loading = ref(true)
const showProfileMenu = ref(false)
const showNotifications = ref(false)

// Computed
const isAuthenticated = computed(() => authStore.isAuthenticated)
const user = computed(() => authStore.user)
const userInitials = computed(() => {
  if (!user.value?.name) return '?'
  return user.value.name.split(' ').map(n => n[0]).join('').toUpperCase()
})
const unreadNotifications = computed(() => notificationStore.unreadCount)

// Methods
const toggleProfileMenu = () => {
  showProfileMenu.value = !showProfileMenu.value
}

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const logout = async () => {
  try {
    await authStore.logout()
    router.push('/login')
  } catch (error) {
    console.error('Logout error:', error)
  }
}

// Lifecycle
onMounted(async () => {
  try {
    // Check if user is already authenticated
    await authStore.checkAuth()
    
    // Initialize notifications
    await notificationStore.initialize()
    
    loading.value = false
  } catch (error) {
    console.error('App initialization error:', error)
    loading.value = false
  }
})

onUnmounted(() => {
  // Cleanup
  notificationStore.cleanup()
})
</script> 