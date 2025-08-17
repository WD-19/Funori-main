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
            {{ locationLoading ? 'Đang cập nhật...' : 'Cập nhật vị trí' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Map Container -->
    <div class="relative">
      <div id="map" class="w-full h-screen"></div>
      
      <!-- Location Info Overlay -->
      <div class="absolute top-4 left-4 right-4 bg-white rounded-lg shadow-lg p-4">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-semibold text-gray-900">Vị trí hiện tại</h3>
            <p class="text-sm text-gray-600">{{ currentLocation.address || 'Đang tải...' }}</p>
          </div>
          <div class="text-right">
            <p class="text-sm text-gray-500">Cập nhật lần cuối</p>
            <p class="text-sm font-medium text-gray-900">{{ lastUpdateTime }}</p>
          </div>
        </div>
      </div>

      <!-- Active Orders Overlay -->
      <div v-if="activeOrders.length > 0" class="absolute bottom-4 left-4 right-4 bg-white rounded-lg shadow-lg p-4">
        <h3 class="font-semibold text-gray-900 mb-3">Đơn hàng đang giao</h3>
        <div class="space-y-2 max-h-32 overflow-y-auto">
          <div 
            v-for="order in activeOrders" 
            :key="order.id"
            class="flex items-center justify-between p-2 bg-gray-50 rounded-lg"
          >
            <div>
              <p class="font-medium text-gray-900">#{{ order.order_number }}</p>
              <p class="text-sm text-gray-600">{{ order.shipping_address }}</p>
            </div>
            <button 
              @click="viewOrder(order.id)"
              class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700"
            >
              Xem
            </button>
          </div>
        </div>
      </div>

      <!-- Location Controls -->
      <div class="absolute top-20 right-4 space-y-2">
        <button 
          @click="centerOnUser"
          class="bg-white p-2 rounded-lg shadow-lg hover:bg-gray-50"
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
            'p-2 rounded-lg shadow-lg',
            trackingEnabled ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-white text-gray-700 hover:bg-gray-50'
          ]"
          :title="trackingEnabled ? 'Tắt theo dõi' : 'Bật theo dõi'"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
        </button>
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
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import 'leaflet/dist/leaflet.css'
import { useRouter } from 'vue-router'
import { useOrderStore } from '../stores/orders'
import { useAuthStore } from '../stores/auth'

const router = useRouter()
const orderStore = useOrderStore()
const authStore = useAuthStore()

const map = ref(null)
const userMarker = ref(null)
const orderMarkers = ref([])
const currentLocation = ref({ lat: 0, lng: 0, address: '' })
const lastUpdateTime = ref('Chưa cập nhật')
const locationLoading = ref(false)
const trackingEnabled = ref(false)
const showPermissionModal = ref(false)
const locationWatcher = ref(null)

const activeOrders = computed(() => {
  return orderStore.orders.filter(order => 
    ['accepted', 'in_delivery'].includes(order.status)
  )
})

onMounted(async () => {
  await initializeMap()
  await checkLocationPermission()
  await loadActiveOrders()
})

onUnmounted(() => {
  if (locationWatcher.value) {
    navigator.geolocation.clearWatch(locationWatcher.value)
  }
})

const initializeMap = async () => {
  // Initialize Leaflet map
  const L = await import('leaflet')
  
  // Set default location (Ho Chi Minh City)
  const defaultLat = 10.8231
  const defaultLng = 106.6297
  
  map.value = L.map('map').setView([defaultLat, defaultLng], 13)
  
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map.value)
  
  // Add user marker
  userMarker.value = L.marker([defaultLat, defaultLng], {
    icon: L.divIcon({
      className: 'user-marker',
      html: '<div class="w-6 h-6 bg-blue-500 rounded-full border-2 border-white shadow-lg"></div>',
      iconSize: [24, 24],
      iconAnchor: [12, 12]
    })
  }).addTo(map.value)
  
  // Add popup to user marker
  userMarker.value.bindPopup('Vị trí của bạn')

  // Ensure map fills container after mount
  setTimeout(() => {
    try {
      if (map.value) {
        map.value.invalidateSize()
      }
    } catch (e) {}
  }, 100)
}

const checkLocationPermission = async () => {
  if (!navigator.geolocation) {
    console.error('Geolocation is not supported')
    return
  }
  
  const permission = await navigator.permissions.query({ name: 'geolocation' })
  
  if (permission.state === 'denied') {
    showPermissionModal.value = true
  } else if (permission.state === 'granted') {
    await getCurrentLocation()
  } else {
    showPermissionModal.value = true
  }
}

const requestLocationPermission = async () => {
  showPermissionModal.value = false
  await getCurrentLocation()
}

const denyLocationPermission = () => {
  showPermissionModal.value = false
}

const getCurrentLocation = () => {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(
      async (position) => {
        const { latitude, longitude } = position.coords
        currentLocation.value = { lat: latitude, lng: longitude }
        
        // Update marker position
        if (userMarker.value) {
          userMarker.value.setLatLng([latitude, longitude])
        }
        
        // Get address from coordinates
        await getAddressFromCoords(latitude, longitude)
        
        // Update last update time
        lastUpdateTime.value = new Date().toLocaleTimeString('vi-VN')
        
        resolve()
      },
      (error) => {
        console.error('Error getting location:', error)
        reject(error)
      },
      {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 60000
      }
    )
  })
}

const getAddressFromCoords = async (lat, lng) => {
  try {
    const response = await fetch(
      `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`
    )
    const data = await response.json()
    currentLocation.value.address = data.display_name
  } catch (error) {
    console.error('Error getting address:', error)
    currentLocation.value.address = `${lat.toFixed(6)}, ${lng.toFixed(6)}`
  }
}

const updateLocation = async () => {
  locationLoading.value = true
  try {
    await getCurrentLocation()
    
    // Send location to server
    await fetch('/api/shipper-app/location', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${authStore.token}`
      },
      body: JSON.stringify({
        latitude: currentLocation.value.lat,
        longitude: currentLocation.value.lng,
        address: currentLocation.value.address
      })
    })
  } catch (error) {
    console.error('Error updating location:', error)
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
    // Stop tracking
    if (locationWatcher.value) {
      navigator.geolocation.clearWatch(locationWatcher.value)
      locationWatcher.value = null
    }
    trackingEnabled.value = false
  } else {
    // Start tracking
    locationWatcher.value = navigator.geolocation.watchPosition(
      async (position) => {
        const { latitude, longitude } = position.coords
        currentLocation.value = { lat: latitude, lng: longitude }
        
        if (userMarker.value) {
          userMarker.value.setLatLng([latitude, longitude])
        }
        
        await getAddressFromCoords(latitude, longitude)
        lastUpdateTime.value = new Date().toLocaleTimeString('vi-VN')
        
        // Auto-update to server every 30 seconds
        await updateLocation()
      },
      (error) => {
        console.error('Error watching location:', error)
      },
      {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 30000
      }
    )
    trackingEnabled.value = true
  }
}

const loadActiveOrders = async () => {
  try {
    await orderStore.fetchOrders()
    addOrderMarkers()
  } catch (error) {
    console.error('Error loading orders:', error)
  }
}

const addOrderMarkers = () => {
  // Clear existing markers
  orderMarkers.value.forEach(marker => {
    if (map.value) map.value.removeLayer(marker)
  })
  orderMarkers.value = []
  
  // Add new markers for active orders
  activeOrders.value.forEach(order => {
    if (order.shipping_latitude && order.shipping_longitude) {
      const L = require('leaflet')
      const marker = L.marker([order.shipping_latitude, order.shipping_longitude], {
        icon: L.divIcon({
          className: 'order-marker',
          html: '<div class="w-6 h-6 bg-red-500 rounded-full border-2 border-white shadow-lg"></div>',
          iconSize: [24, 24],
          iconAnchor: [12, 12]
        })
      }).addTo(map.value)
      
      marker.bindPopup(`
        <div class="p-2">
          <h4 class="font-semibold">#${order.order_number}</h4>
          <p class="text-sm text-gray-600">${order.shipping_address}</p>
          <button onclick="viewOrder(${order.id})" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded text-sm">
            Xem chi tiết
          </button>
        </div>
      `)
      
      orderMarkers.value.push(marker)
    }
  })
}

const viewOrder = (orderId) => {
  router.push(`/orders/${orderId}`)
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
</style> 