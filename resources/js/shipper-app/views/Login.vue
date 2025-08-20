<template>
  <div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 relative overflow-hidden">
    <!-- Full screen background pattern -->
    <div class="absolute inset-0">
      <!-- Animated background circles -->
      <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-10 left-10 w-72 h-72 bg-gradient-to-br from-amber-200 to-orange-300 rounded-full opacity-30 blur-3xl animate-pulse"></div>
        <div class="absolute top-1/4 right-0 w-96 h-96 bg-gradient-to-bl from-orange-200 to-red-300 rounded-full opacity-25 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-gradient-to-tr from-red-200 to-pink-300 rounded-full opacity-20 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-0 w-64 h-64 bg-gradient-to-r from-yellow-200 to-amber-300 rounded-full opacity-15 blur-3xl animate-pulse" style="animation-delay: 3s;"></div>
      </div>
      
      <!-- Geometric patterns -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-20 w-32 h-32 border-4 border-amber-300 rounded-lg transform rotate-45"></div>
        <div class="absolute top-40 right-40 w-24 h-24 border-4 border-orange-300 rounded-full"></div>
        <div class="absolute bottom-40 left-40 w-20 h-20 border-4 border-red-300 transform rotate-12"></div>
        <div class="absolute bottom-20 right-20 w-28 h-28 border-4 border-yellow-300 rounded-lg"></div>
      </div>
    </div>

    <!-- Main content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <!-- Logo and Title -->
        <div class="text-center">
          <div class="mx-auto h-24 w-24 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 mb-6">
            <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
          <h1 class="text-5xl font-bold bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 bg-clip-text text-transparent mb-4">
            Funori
          </h1>
          <h2 class="text-2xl font-semibold text-gray-700 mb-2">
            Delivery System
          </h2>
          <p class="text-lg text-gray-600 font-medium mb-1">
            Hệ thống giao hàng nội thất
          </p>
          <p class="text-sm text-gray-500">
            Đăng nhập để quản lý đơn hàng giao nội thất
          </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/30">
          <!-- Alert Messages -->
          <div v-if="alert.show" :class="alertClasses" class="mb-8 p-4 rounded-2xl border-l-4">
            <div class="flex items-center">
              <svg v-if="alert.type === 'error'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
              </svg>
              <svg v-else class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              <span class="font-medium">{{ alert.message }}</span>
            </div>
          </div>

          <form @submit.prevent="handleLogin" class="space-y-8">
            <div>
              <label for="email" class="block text-sm font-bold text-gray-700 mb-3">
                <div class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                  </svg>
                  Email đăng nhập
                </div>
              </label>
              <div class="relative">
                <input
                  id="email"
                  v-model="form.email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  required
                  :disabled="loading"
                  class="appearance-none relative block w-full px-5 py-4 border-2 border-gray-200 placeholder-gray-400 text-gray-900 rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 focus:z-10 text-base disabled:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow-md"
                  placeholder="Nhập email của bạn"
                />
              </div>
            </div>

            <div>
              <label for="password" class="block text-sm font-bold text-gray-700 mb-3">
                <div class="flex items-center">
                  <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                  Mật khẩu
                </div>
              </label>
              <div class="relative">
                <input
                  id="password"
                  v-model="form.password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  :disabled="loading"
                  class="appearance-none relative block w-full px-5 py-4 border-2 border-gray-200 placeholder-gray-400 text-gray-900 rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/20 focus:border-amber-500 focus:z-10 text-base disabled:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow-md"
                  placeholder="Nhập mật khẩu"
                />
              </div>
            </div>

            <div class="pt-4">
              <button
                type="submit"
                :disabled="loading || !form.email || !form.password"
                class="group relative w-full flex justify-center py-4 px-6 border border-transparent text-base font-bold rounded-2xl text-white bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 hover:from-amber-600 hover:via-orange-600 hover:to-red-600 focus:outline-none focus:ring-4 focus:ring-amber-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl"
              >
                <span v-if="loading" class="absolute left-0 inset-y-0 flex items-center pl-4">
                  <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                </span>
                <span v-else class="absolute left-0 inset-y-0 flex items-center pl-4">
                  <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </span>
                {{ loading ? 'Đang đăng nhập...' : 'Đăng nhập hệ thống' }}
              </button>
            </div>
          </form>

          <!-- Additional Info -->
          <div class="mt-10 text-center">
            <div class="flex items-center justify-center space-x-2 text-gray-500 mb-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span class="text-base font-semibold">Hệ thống giao hàng nội thất Funori</span>
            </div>
            <p class="text-sm text-gray-400 leading-relaxed">
              Quản lý và giao đơn hàng nội thất một cách hiệu quả<br>
              Đảm bảo chất lượng dịch vụ tốt nhất cho khách hàng
            </p>
          </div>
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
    'bg-red-50 text-red-700 border-red-200': alert.value.type === 'error',
    'bg-green-50 text-green-700 border-green-200': alert.value.type === 'success'
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