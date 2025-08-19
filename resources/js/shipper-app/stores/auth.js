import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '../services/api'

export const useAuthStore = defineStore('auth', () => {
  // State
  const user = ref(null)
  const token = ref(localStorage.getItem('shipper_token'))
  const loading = ref(false)

  // Computed
  const isAuthenticated = computed(() => !!token.value && !!user.value)

  // Actions
  const login = async (credentials) => {
    try {
      loading.value = true
      
      const response = await api.post('/shipper-app/login', credentials)
      
      if (response.data.success) {
        const { token: newToken, shipper } = response.data.data
        
        // Save token
        token.value = newToken
        localStorage.setItem('shipper_token', newToken)
        
        // Save user data
        user.value = shipper
        localStorage.setItem('shipper_info', JSON.stringify(shipper))
        
        // Set auth header
        api.defaults.headers.common['Authorization'] = `Bearer ${newToken}`
        
        return { success: true }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Login error:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Đăng nhập thất bại. Vui lòng thử lại.' }
    } finally {
      loading.value = false
    }
  }

  const logout = async () => {
    try {
      // Call logout API
      await api.post('/shipper-app/logout')
    } catch (error) {
      console.error('Logout API error:', error)
    } finally {
      // Clear local data
      user.value = null
      token.value = null
      localStorage.removeItem('shipper_token')
      localStorage.removeItem('shipper_info')
      
      // Clear auth header
      delete api.defaults.headers.common['Authorization']
    }
  }

  const checkAuth = async () => {
    const storedToken = localStorage.getItem('shipper_token')
    const storedUser = localStorage.getItem('shipper_info')
    
    if (!storedToken || !storedUser) {
      return false
    }
    
    try {
      // Set token
      token.value = storedToken
      api.defaults.headers.common['Authorization'] = `Bearer ${storedToken}`
      
      // Verify token with server
      const response = await api.get('/shipper-app/profile')
      
      if (response.data.success) {
        user.value = response.data.data
        return true
      } else {
        // Token invalid, clear data
        await logout()
        return false
      }
    } catch (error) {
      console.error('Auth check error:', error)
      // Token invalid, clear data
      await logout()
      return false
    }
  }

  const updateProfile = async (profileData) => {
    try {
      const response = await api.put('/shipper-app/profile', profileData)
      
      if (response.data.success) {
        user.value = { ...user.value, ...response.data.data }
        localStorage.setItem('shipper_info', JSON.stringify(user.value))
        return { success: true }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Profile update error:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Cập nhật thông tin thất bại.' }
    }
  }

  const changePassword = async (passwordData) => {
    try {
      const response = await api.put('/shipper-app/password', passwordData)
      
      if (response.data.success) {
        return { success: true }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Password change error:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Đổi mật khẩu thất bại.' }
    }
  }

  return {
    // State
    user,
    token,
    loading,
    
    // Computed
    isAuthenticated,
    
    // Actions
    login,
    logout,
    checkAuth,
    updateProfile,
    changePassword
  }
}) 