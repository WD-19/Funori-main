<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
      <div class="px-4 py-3 flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <button @click="$router.go(-1)" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <h1 class="text-lg font-semibold text-gray-900">Bản đồ</h1>
        </div>
        <div class="flex items-center space-x-2">
          <button 
            @click="updateLocation"
            :disabled="locationLoading"
            class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-700 disabled:opacity-50"
          >
            <span v-if="locationLoading" class="flex items-center space-x-1">
              <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span>Cập nhật...</span>
            </span>
            <span v-else>Cập nhật vị trí</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Map Container -->
    <div class="relative">
      <div id="map" class="w-full h-screen"></div>
      
      <!-- Location Info Overlay -->
      <div class="absolute top-4 left-4 right-4 bg-white rounded-lg shadow-lg p-4 z-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
          <div class="flex-1">
            <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Vị trí hiện tại</h3>
            <p class="text-sm text-gray-600 truncate">{{ currentLocation.address || 'Đang tải...' }}</p>
            <p class="text-xs text-gray-500 mt-1">
              {{ currentLocation.lat ? `${currentLocation.lat.toFixed(6)}, ${currentLocation.lng.toFixed(6)}` : '' }}
            </p>
          </div>
          <div class="text-left sm:text-right">
            <p class="text-sm text-gray-500">Cập nhật lần cuối</p>
            <p class="text-sm font-medium text-gray-900">{{ lastUpdateTime }}</p>
          </div>
        </div>
      </div>

      <!-- Active Orders Overlay -->
      <div v-if="activeOrders.length > 0" class="absolute bottom-4 left-4 right-4 bg-white rounded-lg shadow-lg p-4 max-h-48 overflow-hidden z-10">
        <h3 class="font-semibold text-gray-900 mb-3 text-sm sm:text-base">Đơn hàng đang giao ({{ activeOrders.length }})</h3>
        <div class="space-y-2 max-h-32 overflow-y-auto">
          <div 
            v-for="order in activeOrders" 
            :key="order.id"
            class="flex items-center justify-between p-2 bg-gray-50 rounded-lg"
          >
            <div class="flex-1 min-w-0">
              <p class="font-medium text-gray-900 truncate text-sm">#{{ order.order_number }}</p>
              <p class="text-xs sm:text-sm text-gray-600 truncate">{{ order.shipping_address }}</p>
            </div>
            <button 
              @click="viewOrder(order.id)"
              class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 ml-2 flex-shrink-0 min-h-[32px]"
            >
              Xem
            </button>
          </div>
        </div>
      </div>

      <!-- Location Controls -->
      <div class="absolute top-20 right-4 space-y-2 z-10">
        <button 
          @click="centerOnUser"
          class="bg-white p-3 rounded-lg shadow-lg hover:bg-gray-50 transition-colors"
          title="Về vị trí của tôi"
        >
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
        </button>
        <button 
          @click="toggleTracking"
          :class="[
            'p-3 rounded-lg shadow-lg transition-colors',
            trackingEnabled ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-white text-gray-700 hover:bg-gray-50'
          ]"
          :title="trackingEnabled ? 'Tắt theo dõi' : 'Bật theo dõi'"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
        </button>
      </div>

      <!-- Status Indicator -->
      <div class="absolute top-4 right-4 z-10">
        <div class="flex items-center space-x-2 bg-white rounded-lg shadow-lg px-3 py-2">
          <div :class="[
            'w-3 h-3 rounded-full',
            trackingEnabled ? 'bg-green-500 animate-pulse' : 'bg-gray-400'
          ]"></div>
          <span class="text-xs sm:text-sm text-gray-700">
            {{ trackingEnabled ? 'Đang theo dõi' : 'Không theo dõi' }}
          </span>
        </div>
      </div>
    </div>

    <!-- Location Permission Modal -->
    <div v-if="showPermissionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Cho phép truy cập vị trí</h3>
          <p class="text-gray-600 mb-6">Ứng dụng cần quyền truy cập vị trí để hiển thị bản đồ và cập nhật vị trí của bạn.</p>
          <div class="flex space-x-3">
            <button 
              @click="denyLocationPermission"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Từ chối
            </button>
            <button 
              @click="requestLocationPermission"
              class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700"
            >
              Cho phép
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Toast -->
    <div v-if="successMessage" class="fixed bottom-4 left-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg z-50">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <span>{{ successMessage }}</span>
        </div>
        <button @click="successMessage = ''" class="ml-4 text-white hover:text-green-100">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Error Toast -->
    <div v-if="errorMessage" class="fixed bottom-4 left-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg z-50">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span>{{ errorMessage }}</span>
        </div>
        <button @click="errorMessage = ''" class="ml-4 text-white hover:text-red-100">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, nextTick } from 'vue'
import 'leaflet/dist/leaflet.css'
import { useRouter } from 'vue-router'
import { useOrderStore } from '../stores/orders'
import { useAuthStore } from '../stores/auth'

const router = useRouter()
const orderStore = useOrderStore()
const authStore = useAuthStore()

// Reactive state
const map = ref(null)
const userMarker = ref(null)
const orderMarkers = ref([])
const currentLocation = ref({ lat: 0, lng: 0, address: '', accuracy: 0 })
const lastUpdateTime = ref('Chưa cập nhật')
const locationLoading = ref(false)
const trackingEnabled = ref(false)
const showPermissionModal = ref(false)
const locationWatcher = ref(null)
const errorMessage = ref('')
const successMessage = ref('')
const mapInitialized = ref(false)

// Computed
const activeOrders = computed(() => {
  return orderStore.orders.filter(order => 
    ['accepted', 'in_delivery'].includes(order.status)
  )
})

// Lifecycle hooks
onMounted(async () => {
  try {
    await initializeMap()
    await checkLocationPermission()
    await loadActiveOrders()
    
    // Add resize listener để xử lý khi màn hình thay đổi kích thước
    window.addEventListener('resize', handleResize)
    window.addEventListener('orientationchange', handleResize)
  } catch (error) {
    console.error('Error during mount:', error)
    showError('Lỗi khởi tạo bản đồ')
  }
})

onUnmounted(() => {
  cleanupLocationWatcher()
  if (map.value) {
    map.value.remove()
  }
  
  // Remove event listeners
  window.removeEventListener('resize', handleResize)
  window.removeEventListener('orientationchange', handleResize)
})

// Methods
const initializeMap = async () => {
  try {
    // Lazy load Leaflet
    const L = await import('leaflet')
    
    // Set default location (Ho Chi Minh City)
    const defaultLat = 10.8231
    const defaultLng = 106.6297
    
    // Create map instance
    map.value = L.map('map', {
      zoomControl: false, // Disable default zoom control
      attributionControl: false // Disable attribution for cleaner look
    }).setView([defaultLat, defaultLng], 13)
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map.value)
    
    // Add custom zoom control
    L.control.zoom({
      position: 'bottomright'
    }).addTo(map.value)
    
    // Add user marker
    userMarker.value = L.marker([defaultLat, defaultLng], {
      icon: L.divIcon({
        className: 'user-marker',
        html: '<div class="w-8 h-8 bg-blue-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
        iconSize: [32, 32],
        iconAnchor: [16, 16]
      })
    }).addTo(map.value)
    
    // Add popup to user marker
    userMarker.value.bindPopup('Vị trí của bạn')
    
    // Ensure map fills container
    await nextTick()
    if (map.value) {
      map.value.invalidateSize()
    }
    
    mapInitialized.value = true
    console.log('Map initialized successfully')
    
  } catch (error) {
    console.error('Error initializing map:', error)
    throw error
  }
}

const checkLocationPermission = async () => {
  if (!navigator.geolocation) {
    showError('Trình duyệt không hỗ trợ định vị')
    return
  }
  
  try {
    const permission = await navigator.permissions.query({ name: 'geolocation' })
    
    if (permission.state === 'denied') {
      showPermissionModal.value = true
    } else if (permission.state === 'granted') {
      await getCurrentLocation()
    } else {
      showPermissionModal.value = true
    }
  } catch (error) {
    console.error('Error checking permission:', error)
    // Fallback to requesting location directly
    await getCurrentLocation()
  }
}

const requestLocationPermission = async () => {
  showPermissionModal.value = false
  await getCurrentLocation()
}

const denyLocationPermission = () => {
  showPermissionModal.value = false
  showError('Cần quyền truy cập vị trí để sử dụng tính năng bản đồ')
}

const getCurrentLocation = () => {
  return new Promise((resolve, reject) => {
    const options = {
      enableHighAccuracy: true,
      timeout: 15000,
      maximumAge: 60000
    }
    
    navigator.geolocation.getCurrentPosition(
      async (position) => {
        try {
          const { latitude, longitude, accuracy } = position.coords
          currentLocation.value = { 
            lat: latitude, 
            lng: longitude, 
            accuracy: accuracy || 0 
          }
          
          // Update marker position
          if (userMarker.value && map.value) {
            userMarker.value.setLatLng([latitude, longitude])
            
            // Center map on user location if it's the first time
            if (!mapInitialized.value) {
              map.value.setView([latitude, longitude], 15)
              mapInitialized.value = true
            }
          }
          
          // Get address from coordinates
          await getAddressFromCoords(latitude, longitude)
          
          // Update last update time
          lastUpdateTime.value = new Date().toLocaleTimeString('vi-VN')
          
          // Show success message for first location
          if (!mapInitialized.value) {
            showSuccess('Đã lấy vị trí thành công!')
          }
          
          resolve()
        } catch (error) {
          reject(error)
        }
      },
      (error) => {
        console.error('Error getting location:', error)
        let message = 'Lỗi khi lấy vị trí'
        
        switch (error.code) {
          case error.PERMISSION_DENIED:
            message = 'Quyền truy cập vị trí bị từ chối'
            break
          case error.POSITION_UNAVAILABLE:
            message = 'Không thể xác định vị trí'
            break
          case error.TIMEOUT:
            message = 'Hết thời gian chờ xác định vị trí'
            break
        }
        
        showError(message)
        reject(error)
      },
      options
    )
  })
}

const getAddressFromCoords = async (lat, lng) => {
  try {
    const response = await fetch(
      `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=vi`
    )
    
    if (!response.ok) {
      throw new Error('Network response was not ok')
    }
    
    const data = await response.json()
    if (data.display_name) {
      currentLocation.value.address = data.display_name
    } else {
      currentLocation.value.address = `${lat.toFixed(6)}, ${lng.toFixed(6)}`
    }
  } catch (error) {
    console.error('Error getting address:', error)
    currentLocation.value.address = `${lat.toFixed(6)}, ${lng.toFixed(6)}`
  }
}

const updateLocation = async () => {
  if (locationLoading.value) return
  
  locationLoading.value = true
  try {
    await getCurrentLocation()
    
    // Send location to server
    const response = await fetch('/api/shipper-app/location', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${authStore.token}`,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        latitude: currentLocation.value.lat,
        longitude: currentLocation.value.lng,
        address: currentLocation.value.address
      })
    })
    
    if (!response.ok) {
      const errorData = await response.json()
      throw new Error(errorData.message || 'Lỗi cập nhật vị trí')
    }
    
    const result = await response.json()
    if (result.success) {
      console.log('Location updated successfully')
      showSuccess('Cập nhật vị trí thành công!')
    } else {
      throw new Error(result.message || 'Lỗi cập nhật vị trí')
    }
    
  } catch (error) {
    console.error('Error updating location:', error)
    showError(error.message || 'Lỗi cập nhật vị trí')
  } finally {
    locationLoading.value = false
  }
}

const centerOnUser = () => {
  if (map.value && currentLocation.value.lat && currentLocation.value.lng) {
    map.value.setView([currentLocation.value.lat, currentLocation.value.lng], 15)
  }
}

const toggleTracking = () => {
  if (trackingEnabled.value) {
    stopTracking()
  } else {
    startTracking()
  }
}

const startTracking = () => {
  if (!navigator.geolocation) {
    showError('Trình duyệt không hỗ trợ định vị')
    return
  }
  
  const options = {
    enableHighAccuracy: true,
    timeout: 15000,
    maximumAge: 30000
  }
  
  locationWatcher.value = navigator.geolocation.watchPosition(
    async (position) => {
      try {
        const { latitude, longitude, accuracy } = position.coords
        currentLocation.value = { 
          lat: latitude, 
          lng: longitude, 
          accuracy: accuracy || 0 
        }
        
        if (userMarker.value) {
          userMarker.value.setLatLng([latitude, longitude])
        }
        
        await getAddressFromCoords(latitude, longitude)
        lastUpdateTime.value = new Date().toLocaleTimeString('vi-VN')
        
        // Auto-update to server every 30 seconds
        await updateLocation()
      } catch (error) {
        console.error('Error in location watcher:', error)
      }
    },
    (error) => {
      console.error('Error watching location:', error)
      stopTracking()
      showError('Lỗi theo dõi vị trí')
    },
    options
  )
  
  trackingEnabled.value = true
  showSuccess('Đã bật theo dõi vị trí tự động!')
}

const stopTracking = () => {
  cleanupLocationWatcher()
  trackingEnabled.value = false
  showSuccess('Đã tắt theo dõi vị trí tự động!')
}

const cleanupLocationWatcher = () => {
  if (locationWatcher.value) {
    navigator.geolocation.clearWatch(locationWatcher.value)
    locationWatcher.value = null
  }
}

const loadActiveOrders = async () => {
  try {
    await orderStore.fetchOrders()
    addOrderMarkers()
  } catch (error) {
    console.error('Error loading orders:', error)
    showError('Lỗi tải danh sách đơn hàng')
  }
}

const addOrderMarkers = () => {
  if (!map.value) return
  
  // Clear existing markers
  orderMarkers.value.forEach(marker => {
    map.value.removeLayer(marker)
  })
  orderMarkers.value = []
  
  // Add new markers for active orders
  activeOrders.value.forEach(order => {
    if (order.shipping_latitude && order.shipping_longitude) {
      const L = require('leaflet')
      const marker = L.marker([order.shipping_latitude, order.shipping_longitude], {
        icon: L.divIcon({
          className: 'order-marker',
          html: '<div class="w-8 h-8 bg-red-500 rounded-full border-3 border-white shadow-lg flex items-center justify-center"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>',
          iconSize: [32, 32],
          iconAnchor: [16, 16]
        })
      }).addTo(map.value)
      
      marker.bindPopup(`
        <div class="p-3 min-w-64">
          <h4 class="font-semibold text-gray-900 mb-2">#${order.order_number}</h4>
          <p class="text-sm text-gray-600 mb-3">${order.shipping_address}</p>
          <div class="flex space-x-2">
            <button onclick="window.viewOrder(${order.id})" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
              Xem chi tiết
            </button>
          </div>
        </div>
      `)
      
      orderMarkers.value.push(marker)
    }
  })
}

const viewOrder = (orderId) => {
  router.push(`/orders/${orderId}`)
}

const showError = (message) => {
  errorMessage.value = message
  setTimeout(() => {
    errorMessage.value = ''
  }, 5000)
}

const showSuccess = (message) => {
  successMessage.value = message
  setTimeout(() => {
    successMessage.value = ''
  }, 3000)
}

// Handle resize events để map hiển thị đúng
const handleResize = () => {
  if (map.value) {
    // Delay để đảm bảo DOM đã update
    setTimeout(() => {
      map.value.invalidateSize()
    }, 100)
  }
}

// Expose viewOrder function globally for popup buttons
window.viewOrder = viewOrder
</script>

<style scoped>
.user-marker {
  background: transparent;
  border: none;
}

.order-marker {
  background: transparent;
  border: none;
}

#map {
  z-index: 1;
}

/* Mobile optimizations - chỉ sửa những gì thực sự cần */
@media (max-width: 768px) {
  /* Đảm bảo map container responsive */
  #map {
    height: 100vh;
    width: 100vw;
  }
  
  /* Tối ưu overlay cho mobile - tránh bị chồng lấp */
  .absolute.top-4.left-4.right-4 {
    max-width: calc(100vw - 2rem);
  }
  
  .absolute.bottom-4.left-4.right-4 {
    max-width: calc(100vw - 2rem);
  }
  
  /* Đảm bảo buttons dễ nhấn trên mobile */
  button {
    min-height: 44px;
  }
  
  /* Tối ưu text size cho mobile */
  .text-sm {
    font-size: 0.875rem;
  }
  
  .text-xs {
    font-size: 0.75rem;
  }
}

/* Smooth transitions */
.transition-colors {
  transition: all 0.2s ease-in-out;
}

/* Custom scrollbar for orders */
.overflow-y-auto::-webkit-scrollbar {
  width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 2px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style> 