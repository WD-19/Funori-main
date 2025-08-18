import axios from 'axios'

// Create axios instance
const api = axios.create({
  baseURL: '/api',
  timeout: 10000,
  headers: {
    'Accept': 'application/json'
  }
})

// Request interceptor
api.interceptors.request.use(
  (config) => {
    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
    if (csrfToken) {
      config.headers['X-CSRF-TOKEN'] = csrfToken
    }
    
    // Add auth token if available
    const token = localStorage.getItem('shipper_token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    
    // Set Content-Type to application/json only if not FormData
    if (!(config.data instanceof FormData)) {
      config.headers['Content-Type'] = 'application/json'
    }
    
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// Response interceptor
api.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    // Handle 401 errors (unauthorized)
    if (error.response?.status === 401) {
      // Clear auth data
      localStorage.removeItem('shipper_token')
      localStorage.removeItem('shipper_info')
      
      // Redirect to shipper login if not already there
      if (window.location.pathname !== '/shipper-app/login') {
        window.location.href = '/shipper-app/login'
      }
    }
    
    return Promise.reject(error)
  }
)

export default api 