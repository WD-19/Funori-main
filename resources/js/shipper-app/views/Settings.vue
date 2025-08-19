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
          <h1 class="text-lg font-semibold text-gray-900">Cài đặt</h1>
        </div>
      </div>
    </div>

    <!-- Settings Content -->
    <div class="p-4 space-y-6">
      <!-- Notifications Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông báo</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Thông báo đơn hàng mới</p>
              <p class="text-sm text-gray-500">Nhận thông báo khi có đơn hàng mới</p>
            </div>
            <button 
              @click="toggleSetting('newOrderNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.newOrderNotifications ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.newOrderNotifications ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Thông báo cập nhật trạng thái</p>
              <p class="text-sm text-gray-500">Nhận thông báo khi trạng thái đơn hàng thay đổi</p>
            </div>
            <button 
              @click="toggleSetting('statusUpdateNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.statusUpdateNotifications ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.statusUpdateNotifications ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Thông báo âm thanh</p>
              <p class="text-sm text-gray-500">Phát âm thanh khi có thông báo mới</p>
            </div>
            <button 
              @click="toggleSetting('soundNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.soundNotifications ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.soundNotifications ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
        </div>
      </div>

      <!-- Location Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vị trí</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Tự động cập nhật vị trí</p>
              <p class="text-sm text-gray-500">Tự động gửi vị trí khi đang giao hàng</p>
            </div>
            <button 
              @click="toggleSetting('autoLocationUpdate')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.autoLocationUpdate ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.autoLocationUpdate ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Độ chính xác cao</p>
              <p class="text-sm text-gray-500">Sử dụng GPS độ chính xác cao (tiêu tốn pin hơn)</p>
            </div>
            <button 
              @click="toggleSetting('highAccuracyGPS')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.highAccuracyGPS ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.highAccuracyGPS ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tần suất cập nhật vị trí</label>
            <select 
              v-model="settings.locationUpdateInterval"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="30">30 giây</option>
              <option value="60">1 phút</option>
              <option value="300">5 phút</option>
              <option value="600">10 phút</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Display Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hiển thị</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Chế độ tối</p>
              <p class="text-sm text-gray-500">Sử dụng giao diện tối</p>
            </div>
            <button 
              @click="toggleSetting('darkMode')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.darkMode ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.darkMode ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Hiển thị đơn hàng đã hoàn thành</p>
              <p class="text-sm text-gray-500">Hiển thị đơn hàng đã giao trong danh sách</p>
            </div>
            <button 
              @click="toggleSetting('showCompletedOrders')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
                settings.showCompletedOrders ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.showCompletedOrders ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Số đơn hàng hiển thị</label>
            <select 
              v-model="settings.ordersPerPage"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="10">10 đơn hàng</option>
              <option value="20">20 đơn hàng</option>
              <option value="50">50 đơn hàng</option>
              <option value="100">100 đơn hàng</option>
            </select>
          </div>
        </div>
      </div>

      <!-- App Information -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin ứng dụng</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Phiên bản</p>
              <p class="text-sm text-gray-500">v1.0.0</p>
            </div>
            <div class="text-right">
              <p class="font-medium text-gray-900">Ngày cập nhật</p>
              <p class="text-sm text-gray-500">{{ formatDate(new Date()) }}</p>
            </div>
          </div>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Nhà phát triển</p>
              <p class="text-sm text-gray-500">Funori Team</p>
            </div>
            <div class="text-right">
              <p class="font-medium text-gray-900">Hỗ trợ</p>
              <p class="text-sm text-gray-500">support@funori.com</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Management -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quản lý dữ liệu</h3>
        <div class="space-y-4">
          <button 
            @click="clearCache"
            class="flex items-center space-x-3 w-full p-4 border border-gray-200 rounded-lg hover:bg-gray-50"
          >
            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
            </div>
            <div class="text-left">
              <p class="font-medium text-gray-900">Xóa bộ nhớ cache</p>
              <p class="text-sm text-gray-500">Xóa dữ liệu tạm thời của ứng dụng</p>
            </div>
          </button>
          
          <button 
            @click="exportData"
            class="flex items-center space-x-3 w-full p-4 border border-gray-200 rounded-lg hover:bg-gray-50"
          >
            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <div class="text-left">
              <p class="font-medium text-gray-900">Xuất dữ liệu</p>
              <p class="text-sm text-gray-500">Tải xuống dữ liệu đơn hàng</p>
            </div>
          </button>
          
          <button 
            @click="resetSettings"
            class="flex items-center space-x-3 w-full p-4 border border-gray-200 rounded-lg hover:bg-gray-50"
          >
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
            </div>
            <div class="text-left">
              <p class="font-medium text-gray-900">Đặt lại cài đặt</p>
              <p class="text-sm text-gray-500">Khôi phục cài đặt mặc định</p>
            </div>
          </button>
        </div>
      </div>

      <!-- About -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Về ứng dụng</h3>
        <div class="space-y-4">
          <p class="text-gray-600">
            Ứng dụng Shipper Funori được thiết kế để giúp các shipper quản lý đơn hàng một cách hiệu quả. 
            Với các tính năng như theo dõi vị trí, cập nhật trạng thái đơn hàng, và thông báo real-time.
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm">Điều khoản sử dụng</a>
            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm">Chính sách bảo mật</a>
            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm">Hướng dẫn sử dụng</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Reset Settings Modal -->
    <div v-if="showResetModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="text-center">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Đặt lại cài đặt</h3>
          <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn đặt lại tất cả cài đặt về mặc định? Hành động này không thể hoàn tác.</p>
          <div class="flex space-x-3">
            <button 
              @click="showResetModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              @click="confirmResetSettings"
              class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700"
            >
              Đặt lại
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const settings = ref({
  // Notifications
  newOrderNotifications: true,
  statusUpdateNotifications: true,
  soundNotifications: true,
  
  // Location
  autoLocationUpdate: true,
  highAccuracyGPS: false,
  locationUpdateInterval: 60,
  
  // Display
  darkMode: false,
  showCompletedOrders: false,
  ordersPerPage: 20
})

const showResetModal = ref(false)

onMounted(() => {
  loadSettings()
})

const loadSettings = () => {
  const savedSettings = localStorage.getItem('shipper-app-settings')
  if (savedSettings) {
    settings.value = { ...settings.value, ...JSON.parse(savedSettings) }
  }
}

const saveSettings = () => {
  localStorage.setItem('shipper-app-settings', JSON.stringify(settings.value))
}

const toggleSetting = (key) => {
  settings.value[key] = !settings.value[key]
  saveSettings()
}

const clearCache = () => {
  // Clear localStorage except settings
  const settings = localStorage.getItem('shipper-app-settings')
  localStorage.clear()
  if (settings) {
    localStorage.setItem('shipper-app-settings', settings)
  }
  
  // Clear sessionStorage
  sessionStorage.clear()
  
  // Reload page
  window.location.reload()
}

const exportData = () => {
  // This would typically export order data
  // For now, just show a message
  alert('Tính năng xuất dữ liệu sẽ được phát triển trong phiên bản tiếp theo.')
}

const resetSettings = () => {
  showResetModal.value = true
}

const confirmResetSettings = () => {
  // Reset to default settings
  settings.value = {
    newOrderNotifications: true,
    statusUpdateNotifications: true,
    soundNotifications: true,
    autoLocationUpdate: true,
    highAccuracyGPS: false,
    locationUpdateInterval: 60,
    darkMode: false,
    showCompletedOrders: false,
    ordersPerPage: 20
  }
  
  saveSettings()
  showResetModal.value = false
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('vi-VN')
}
</script> 