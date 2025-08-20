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
    <div class="p-3 md:p-4 space-y-4 md:space-y-6">
      <!-- Notifications Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông báo</h3>
        <div class="space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Thông báo đơn hàng mới</p>
              <p class="text-sm text-gray-500">Nhận thông báo khi có đơn hàng mới</p>
            </div>
            <button 
              @click="toggleSetting('newOrderNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
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
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Thông báo cập nhật trạng thái</p>
              <p class="text-sm text-gray-500">Nhận thông báo khi trạng thái đơn hàng thay đổi</p>
            </div>
            <button 
              @click="toggleSetting('statusUpdateNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
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
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Thông báo âm thanh</p>
              <p class="text-sm text-gray-500">Phát âm thanh khi có thông báo mới</p>
            </div>
            <button 
              @click="toggleSetting('soundNotifications')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
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
      <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vị trí</h3>
        <div class="space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Tự động cập nhật vị trí</p>
              <p class="text-sm text-gray-500">Tự động gửi vị trí khi đang giao hàng</p>
            </div>
            <button 
              @click="toggleSetting('autoLocationUpdate')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
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
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Độ chính xác cao</p>
              <p class="text-sm text-gray-500">Sử dụng GPS để có vị trí chính xác hơn</p>
            </div>
            <button 
              @click="toggleSetting('highAccuracyLocation')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
                settings.highAccuracyLocation ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.highAccuracyLocation ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Tần suất cập nhật</p>
              <p class="text-sm text-gray-500">Cập nhật vị trí mỗi 30 giây</p>
            </div>
            <select 
              v-model="settings.locationUpdateInterval"
              class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-shrink-0"
            >
              <option value="15">15 giây</option>
              <option value="30">30 giây</option>
              <option value="60">1 phút</option>
              <option value="300">5 phút</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Privacy Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quyền riêng tư</h3>
        <div class="space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Chia sẻ vị trí với khách hàng</p>
              <p class="text-sm text-gray-500">Cho phép khách hàng xem vị trí hiện tại của bạn</p>
            </div>
            <button 
              @click="toggleSetting('shareLocationWithCustomer')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
                settings.shareLocationWithCustomer ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.shareLocationWithCustomer ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Hiển thị trạng thái online</p>
              <p class="text-sm text-gray-500">Cho phép người khác biết bạn đang online</p>
            </div>
            <button 
              @click="toggleSetting('showOnlineStatus')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
                settings.showOnlineStatus ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.showOnlineStatus ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
        </div>
      </div>

      <!-- App Settings -->
      <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ứng dụng</h3>
        <div class="space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Chế độ tối</p>
              <p class="text-sm text-gray-500">Sử dụng giao diện tối để tiết kiệm pin</p>
            </div>
            <button 
              @click="toggleSetting('darkMode')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
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
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Ngôn ngữ</p>
              <p class="text-sm text-gray-500">Chọn ngôn ngữ hiển thị</p>
            </div>
            <select 
              v-model="settings.language"
              class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-shrink-0"
            >
              <option value="vi">Tiếng Việt</option>
              <option value="en">English</option>
            </select>
          </div>
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Kích thước font</p>
              <p class="text-sm text-gray-500">Điều chỉnh kích thước chữ</p>
            </div>
            <select 
              v-model="settings.fontSize"
              class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-shrink-0"
            >
              <option value="small">Nhỏ</option>
              <option value="medium">Vừa</option>
              <option value="large">Lớn</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Data & Storage -->
      <div class="bg-white rounded-lg shadow-sm border p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Dữ liệu & Lưu trữ</h3>
        <div class="space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Tự động xóa cache</p>
              <p class="text-sm text-gray-500">Xóa dữ liệu tạm mỗi 7 ngày</p>
            </div>
            <button 
              @click="toggleSetting('autoClearCache')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
                settings.autoClearCache ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.autoClearCache ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
          
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
            <div class="flex-1">
              <p class="font-medium text-gray-900">Đồng bộ dữ liệu</p>
              <p class="text-sm text-gray-500">Tự động đồng bộ khi có kết nối internet</p>
            </div>
            <button 
              @click="toggleSetting('autoSync')"
              :class="[
                'relative inline-flex h-6 w-11 items-center rounded-full transition-colors flex-shrink-0',
                settings.autoSync ? 'bg-blue-600' : 'bg-gray-200'
              ]"
            >
              <span 
                :class="[
                  'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                  settings.autoSync ? 'translate-x-6' : 'translate-x-1'
                ]"
              ></span>
            </button>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
        <button 
          @click="resetToDefaults"
          class="w-full sm:w-auto px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium"
        >
          Khôi phục mặc định
        </button>
        <button 
          @click="saveSettings"
          :disabled="saving"
          class="w-full sm:w-auto bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 disabled:opacity-50"
        >
          {{ saving ? 'Đang lưu...' : 'Lưu cài đặt' }}
        </button>
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
  highAccuracyLocation: false, // Renamed from highAccuracyGPS
  locationUpdateInterval: 30,
  
  // Privacy
  shareLocationWithCustomer: false,
  showOnlineStatus: false,
  
  // App Settings
  darkMode: false,
  language: 'vi',
  fontSize: 'medium',
  
  // Data & Storage
  autoClearCache: true,
  autoSync: true,
  
  // Display
  showCompletedOrders: false, // Kept from original, though not in new template
  ordersPerPage: 20 // Kept from original, though not in new template
})

const saving = ref(false)

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
  saving.value = true
  setTimeout(() => {
    saving.value = false
  }, 1000) // Simulate saving
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
    highAccuracyLocation: false, // Renamed from highAccuracyGPS
    locationUpdateInterval: 30,
    shareLocationWithCustomer: false,
    showOnlineStatus: false,
    darkMode: false,
    language: 'vi',
    fontSize: 'medium',
    autoClearCache: true,
    autoSync: true,
    showCompletedOrders: false,
    ordersPerPage: 20
  }
  
  saveSettings()
  showResetModal.value = false
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('vi-VN')
}

const resetToDefaults = () => {
  confirmResetSettings()
}
</script> 