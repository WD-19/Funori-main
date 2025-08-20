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
          <h1 class="text-lg font-semibold text-gray-900">Hồ sơ cá nhân</h1>
        </div>
        <button 
          v-if="!isEditing"
          @click="startEditing"
          class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-700"
        >
          Chỉnh sửa
        </button>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="flex items-center justify-center py-12">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
    </div>

    <!-- Profile Content -->
    <div v-else class="p-4 space-y-6">
      <!-- Profile Header -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <div class="flex items-center space-x-4">
          <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <div class="flex-1">
            <h2 class="text-xl font-semibold text-gray-900">{{ user?.name }}</h2>
            <p class="text-gray-600">{{ user?.email }}</p>
            <p class="text-sm text-gray-500">Shipper ID: {{ user?.id }}</p>
          </div>
          <div class="text-right">
            <span :class="getStatusClass(user?.status)" class="px-3 py-1 rounded-full text-sm font-medium">
              {{ getStatusText(user?.status) }}
            </span>
          </div>
        </div>
      </div>

      <!-- Personal Information -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin cá nhân</h3>
        
        <div v-if="!isEditing" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
              <p class="text-gray-900">{{ user?.name }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <p class="text-gray-900">{{ user?.email }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
              <p class="text-gray-900">{{ user?.phone }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
              <p class="text-gray-900">{{ user?.address || 'Chưa cập nhật' }}</p>
            </div>
          </div>
        </div>

        <form v-else @submit.prevent="saveProfile" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
              <input 
                v-model="editForm.name"
                type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input 
                v-model="editForm.email"
                type="email"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
              <input 
                v-model="editForm.phone"
                type="tel"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
              <input 
                v-model="editForm.address"
                type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>
          </div>
          
          <div class="flex space-x-3 pt-4">
            <button 
              type="button"
              @click="cancelEditing"
              class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              type="submit"
              :disabled="saving"
              class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 disabled:opacity-50"
            >
              {{ saving ? 'Đang lưu...' : 'Lưu thay đổi' }}
            </button>
          </div>
        </form>
      </div>

      <!-- Account Statistics -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thống kê tài khoản</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="text-center">
            <div class="text-2xl font-bold text-blue-600">{{ stats.total_orders || 0 }}</div>
            <div class="text-sm text-gray-600">Tổng đơn hàng</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-green-600">{{ stats.delivered_orders || 0 }}</div>
            <div class="text-sm text-gray-600">Đã giao hàng</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-yellow-600">{{ stats.processing_orders || 0 }}</div>
            <div class="text-sm text-gray-600">Đang xử lý</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-purple-600">{{ formatCurrency(stats.total_earnings || 0) }}</div>
            <div class="text-sm text-gray-600">Tổng thu nhập</div>
          </div>
        </div>
      </div>

      <!-- Account Information -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin tài khoản</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Ngày tham gia</p>
              <p class="text-sm text-gray-500">{{ formatDate(user?.created_at) }}</p>
            </div>
            <div class="text-right">
              <p class="font-medium text-gray-900">Đăng nhập cuối</p>
              <p class="text-sm text-gray-500">{{ formatDateTime(user?.last_login_at) }}</p>
            </div>
          </div>
          <div class="flex items-center justify-between">
            <div>
              <p class="font-medium text-gray-900">Trạng thái online</p>
              <p class="text-sm text-gray-500">{{ user?.is_online ? 'Đang online' : 'Offline' }}</p>
            </div>
            <div class="text-right">
              <p class="font-medium text-gray-900">Cập nhật cuối</p>
              <p class="text-sm text-gray-500">{{ formatDateTime(user?.updated_at) }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao tác nhanh</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <button 
            @click="showChangePasswordModal = true"
            class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50"
          >
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <div class="text-left">
              <p class="font-medium text-gray-900">Đổi mật khẩu</p>
              <p class="text-sm text-gray-500">Cập nhật mật khẩu tài khoản</p>
            </div>
          </button>
          <button 
            @click="logout"
            class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50"
          >
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
            </div>
            <div class="text-left">
              <p class="font-medium text-gray-900">Đăng xuất</p>
              <p class="text-sm text-gray-500">Thoát khỏi tài khoản</p>
            </div>
          </button>
        </div>
      </div>
    </div>

    <!-- Change Password Modal -->
    <div v-if="showChangePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Đổi mật khẩu</h3>
        <form @submit.prevent="changePassword" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu hiện tại</label>
            <input 
              v-model="passwordForm.current_password"
              type="password"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu mới</label>
            <input 
              v-model="passwordForm.new_password"
              type="password"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu mới</label>
            <input 
              v-model="passwordForm.new_password_confirmation"
              type="password"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>
          <div class="flex space-x-3 pt-4">
            <button 
              type="button"
              @click="showChangePasswordModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              type="submit"
              :disabled="changingPassword"
              class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 disabled:opacity-50"
            >
              {{ changingPassword ? 'Đang đổi...' : 'Đổi mật khẩu' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { useOrderStore } from '../stores/orders'

const router = useRouter()
const authStore = useAuthStore()
const orderStore = useOrderStore()

const loading = ref(false)
const saving = ref(false)
const changingPassword = ref(false)
const isEditing = ref(false)
const showChangePasswordModal = ref(false)

const user = computed(() => authStore.user)
const stats = computed(() => orderStore.stats)

const editForm = ref({
  name: '',
  email: '',
  phone: '',
  address: ''
})

const passwordForm = ref({
  current_password: '',
  new_password: '',
  new_password_confirmation: ''
})

onMounted(async () => {
  loading.value = true
  try {
    await orderStore.fetchOrders()
    resetEditForm()
  } catch (error) {
    console.error('Error loading profile data:', error)
  } finally {
    loading.value = false
  }
})

const resetEditForm = () => {
  editForm.value = {
    name: user.value?.name || '',
    email: user.value?.email || '',
    phone: user.value?.phone || '',
    address: user.value?.address || ''
  }
}

const startEditing = () => {
  resetEditForm()
  isEditing.value = true
}

const cancelEditing = () => {
  isEditing.value = false
  resetEditForm()
}

const saveProfile = async () => {
  saving.value = true
  try {
    await authStore.updateProfile(editForm.value)
    isEditing.value = false
  } catch (error) {
    console.error('Error updating profile:', error)
  } finally {
    saving.value = false
  }
}

const changePassword = async () => {
  changingPassword.value = true
  try {
    await authStore.changePassword(passwordForm.value)
    showChangePasswordModal.value = false
    passwordForm.value = {
      current_password: '',
      new_password: '',
      new_password_confirmation: ''
    }
  } catch (error) {
    console.error('Error changing password:', error)
  } finally {
    changingPassword.value = false
  }
}

const logout = async () => {
  try {
    await authStore.logout()
    router.push('/login')
  } catch (error) {
    console.error('Error logging out:', error)
  }
}

const getStatusText = (status) => {
  const statusMap = {
    'active': 'Hoạt động',
    'inactive': 'Không hoạt động',
    'suspended': 'Tạm khóa'
  }
  return statusMap[status] || status
}

const getStatusClass = (status) => {
  const classMap = {
    'active': 'bg-green-100 text-green-800',
    'inactive': 'bg-gray-100 text-gray-800',
    'suspended': 'bg-red-100 text-red-800'
  }
  return classMap[status] || 'bg-gray-100 text-gray-800'
}

const formatDate = (date) => {
  if (!date) return 'Chưa có'
  return new Date(date).toLocaleDateString('vi-VN')
}

const formatDateTime = (date) => {
  if (!date) return 'Chưa có'
  return new Date(date).toLocaleString('vi-VN')
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
  }).format(amount)
}
</script> 