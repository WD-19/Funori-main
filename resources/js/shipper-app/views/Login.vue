<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- Logo and Title -->
      <div class="text-center">
        <div class="mx-auto h-16 w-16 bg-white rounded-full flex items-center justify-center shadow-lg">
          <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h2 class="mt-6 text-3xl font-extrabold text-white">
          Shipper App
        </h2>
        <p class="mt-2 text-sm text-blue-100">
          Đăng nhập để quản lý đơn hàng
        </p>
      </div>

      <!-- Login Form -->
      <div class="bg-white rounded-lg shadow-xl p-8">
        <!-- Demo Credentials -->
        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
          <h3 class="text-sm font-medium text-blue-800 mb-2">
            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Thông tin demo:
          </h3>
          <div class="space-y-1 text-xs text-blue-700">
            <div><strong>Shipper 1:</strong> shipper1@demo.com / 123456</div>
            <div><strong>Shipper 2:</strong> shipper2@demo.com / 123456</div>
            <div><strong>Shipper 3:</strong> shipper3@demo.com / 123456</div>
          </div>
        </div>

        <!-- Alert Messages -->
        <div v-if="alert.show" :class="alertClasses" class="mb-4 p-4 rounded-lg">
          {{ alert.message }}
        </div>

        <form @submit.prevent="handleLogin" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email
            </label>
            <div class="mt-1">
              <input
                id="email"
                v-model="form.email"
                name="email"
                type="email"
                autocomplete="email"
                required
                :disabled="loading"
                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm disabled:bg-gray-100"
                placeholder="Nhập email của bạn"
              />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              Mật khẩu
            </label>
            <div class="mt-1">
              <input
                id="password"
                v-model="form.password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                :disabled="loading"
                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm disabled:bg-gray-100"
                placeholder="Nhập mật khẩu"
              />
            </div>
          </div>

          <div>
            <button
              type="submit"
              :disabled="loading || !form.email || !form.password"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="loading" class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </span>
              <span v-else class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
              </span>
              {{ loading ? 'Đang đăng nhập...' : 'Đăng nhập' }}
            </button>
          </div>
        </form>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
          <p class="text-xs text-gray-500">
            Ứng dụng dành cho shipper để quản lý và giao đơn hàng
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

// Stores and router
const authStore = useAuthStore()
const router = useRouter()

// Reactive data
const loading = ref(false)
const form = ref({
  email: '',
  password: ''
})
const alert = ref({
  show: false,
  message: '',
  type: 'error'
})

// Computed
const alertClasses = computed(() => {
  return {
    'bg-red-50 text-red-700 border border-red-200': alert.value.type === 'error',
    'bg-green-50 text-green-700 border border-green-200': alert.value.type === 'success'
  }
})

// Methods
const showAlert = (message, type = 'error') => {
  alert.value = {
    show: true,
    message,
    type
  }
  
  // Auto hide after 5 seconds
  setTimeout(() => {
    alert.value.show = false
  }, 5000)
}

const handleLogin = async () => {
  if (!form.value.email || !form.value.password) {
    showAlert('Vui lòng nhập đầy đủ email và mật khẩu')
    return
  }

  loading.value = true
  
  try {
    const result = await authStore.login({
      email: form.value.email,
      password: form.value.password
    })
    
    if (result.success) {
      showAlert('Đăng nhập thành công! Đang chuyển hướng...', 'success')
      
      // Redirect to dashboard after a short delay
      setTimeout(() => {
        router.push('/')
      }, 1500)
    } else {
      showAlert(result.message || 'Đăng nhập thất bại')
    }
  } catch (error) {
    console.error('Login error:', error)
    showAlert('Có lỗi xảy ra. Vui lòng thử lại.')
  } finally {
    loading.value = false
  }
}
</script> 