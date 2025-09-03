import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '../services/api'

export const useOrderStore = defineStore('orders', () => {
  // State
  const orders = ref([])
  const currentOrder = ref(null)
  const loading = ref(false)
  const stats = ref({
    totalOrders: 0,
    processingOrders: 0,
    deliveredOrders: 0,
    todayOrders: 0,
    totalEarnings: 0
  })

  // Computed
  const recentOrders = computed(() => {
    return orders.value.slice(0, 5)
  })

  const processingOrders = computed(() => {
    return orders.value.filter(order => 
      ['processing', 'shipped'].includes(order.order_status)
    )
  })

  const pendingOrders = computed(() => {
    return orders.value.filter(order => 
      ['pending', 'confirmed'].includes(order.order_status)
    )
  })

  // Actions
  const fetchOrders = async () => {
    try {
      loading.value = true
      
      const response = await api.get('/shipper-app/orders')
      
      if (response.data.success) {
        orders.value = response.data.data.orders
        stats.value = response.data.data.stats
      }
    } catch (error) {
      console.error('Error fetching orders:', error)
      throw error
    } finally {
      loading.value = false
    }
  }

  const fetchOrder = async (orderId) => {
    try {
      loading.value = true
      
      const response = await api.get(`/shipper-app/orders/${orderId}`)
      
      if (response.data.success) {
        currentOrder.value = response.data.data
        return response.data.data
      }
    } catch (error) {
      console.error('Error fetching order:', error)
      throw error
    } finally {
      loading.value = false
    }
  }
  
  const addOrder = (order) => {
    // Validate order data
    if (!order || !order.id) {
      console.error('Invalid order data in addOrder:', order)
      return
    }
    
    // Check if order already exists
    const existingOrderIndex = orders.value.findIndex(o => o.id === order.id)
    
    if (existingOrderIndex >= 0) {
      // Update existing order
      orders.value[existingOrderIndex] = { ...orders.value[existingOrderIndex], ...order }
    } else {
      // Add new order to the beginning of the list
      orders.value.unshift(order)
    }
    
    // Update stats
    stats.value.totalOrders = orders.value.length
    stats.value.todayOrders = orders.value.filter(o => {
      const orderDate = new Date(o.created_at).toDateString()
      const today = new Date().toDateString()
      return orderDate === today
    }).length
  }
  
  const updateOrder = (order) => {
    // Validate order data
    if (!order || !order.id) {
      console.error('Invalid order data in updateOrder:', order)
      return
    }
    
    const existingOrderIndex = orders.value.findIndex(o => o.id === order.id)
    
    if (existingOrderIndex >= 0) {
      orders.value[existingOrderIndex] = { ...orders.value[existingOrderIndex], ...order }
    }
  }
  
  const updateOrderLocation = (orderId, location) => {
    const existingOrderIndex = orders.value.findIndex(o => o.id === orderId)
    
    if (existingOrderIndex >= 0) {
      orders.value[existingOrderIndex] = { 
        ...orders.value[existingOrderIndex], 
        location: location 
      }
    }
  }

  const updateOrderStatus = async (orderId, status, notes = '', location = null) => {
    try {
      loading.value = true
      
      const payload = {
        status,
        notes
      }
      
      if (location) {
        payload.location = location
      }
      
      const response = await api.post(`/shipper-app/orders/${orderId}/status`, payload)
      
      if (response.data.success) {
        const updated = response.data.data
        // Nếu đơn đã bị unassign (shipper_id null) sau khi từ chối, loại khỏi danh sách shipper ngay
        // Nếu backend trả về shipper_id null => đơn đã được UNASSIGN (shipper từ chối) nên loại bỏ khỏi danh sách
        if (updated && updated.shipper_id === null) {
          orders.value = orders.value.filter(o => o.id !== orderId)
          if (currentOrder.value && currentOrder.value.id === orderId) {
            currentOrder.value = null
          }
        } else {
          // Cập nhật tại chỗ nếu vẫn còn thuộc shipper
          const orderIndex = orders.value.findIndex(order => order.id === orderId)
          if (orderIndex !== -1) {
            orders.value[orderIndex] = updated
          }
          if (currentOrder.value && currentOrder.value.id === orderId) {
            currentOrder.value = updated
          }
        }
        
        // Refresh stats
        await fetchOrders()
        
        return { success: true, data: response.data.data }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Error updating order status:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Cập nhật trạng thái thất bại.' }
    } finally {
      loading.value = false
    }
  }

  const updateOrderStatusWithImage = async (orderId, status, notes = '', image = null) => {
    try {
      loading.value = true
      
      const formData = new FormData()
      formData.append('status', status)
      formData.append('notes', notes)
      
      // Chỉ thêm ảnh vào formData nếu image là instance của File
      if (image && image instanceof File) {
        formData.append('image', image)
      }
      
      const response = await api.post(`/shipper-app/orders/${orderId}/status`, formData)
      
      if (response.data.success) {
        // Update order in local state
        const orderIndex = orders.value.findIndex(order => order.id === orderId)
        if (orderIndex !== -1) {
          orders.value[orderIndex] = response.data.data
        }
        
        // Update current order if it's the same
        if (currentOrder.value && currentOrder.value.id === orderId) {
          currentOrder.value = response.data.data
        }
        
        // Refresh stats
        await fetchOrders()
        
        return { success: true, data: response.data.data }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Error updating order status with image:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Cập nhật trạng thái thất bại.' }
    } finally {
      loading.value = false
    }
  }

  const acceptOrder = async (orderId) => {
    return await updateOrderStatus(orderId, 'processing', 'Shipper đã nhận đơn hàng')
  }

  const startDelivery = async (orderId) => {
    return await updateOrderStatus(orderId, 'shipped', 'Đang giao hàng')
  }

  const startDeliveryWithImage = async (orderId, notes = '', image = null, location = null) => {
    try {
      loading.value = true;
      const formData = new FormData();
      formData.append('status', 'shipped');
      formData.append('notes', notes || 'Đang giao hàng');
      
      // Chỉ thêm ảnh vào formData nếu image là instance của File
      if (image && image instanceof File) {
        formData.append('image', image);
      }
      
      if (location) {
        formData.append('location[lat]', location.lat);
        formData.append('location[lng]', location.lng);
      }
      const response = await api.post(`/shipper-app/orders/${orderId}/status`, formData);
      
      if (response.data.success) {
        // Update order in local state
        const orderIndex = orders.value.findIndex(order => order.id === orderId)
        if (orderIndex !== -1) {
          orders.value[orderIndex] = response.data.data
        }
        
        // Update current order if it's the same
        if (currentOrder.value && currentOrder.value.id === orderId) {
          currentOrder.value = response.data.data
        }
        
        // Refresh stats
        await fetchOrders()
        
        return { success: true, data: response.data.data }
      } else {
        return { success: false, message: response.data.message }
      }
    } catch (error) {
      console.error('Error starting delivery with image:', error)
      
      if (error.response?.data?.message) {
        return { success: false, message: error.response.data.message }
      }
      
      return { success: false, message: 'Bắt đầu giao hàng thất bại.' }
    } finally {
      loading.value = false
    }
  }

  const completeDelivery = async (orderId, deliveryNotes = '') => {
    return await updateOrderStatus(orderId, 'delivered', deliveryNotes)
  }

  const cancelOrder = async (orderId, reason = '') => {
    return await updateOrderStatus(orderId, 'cancelled', reason)
  }

  const returnToWarehouse = async (orderId, notes = '') => {
    return await updateOrderStatus(orderId, 'returned', notes || 'Đã hoàn trả hàng về kho')
  }

  // Map toàn bộ sang tiếng Việt; 'confirmed' hợp nhất vào 'Đang xử lý'
  const getOrderStatusText = (status) => {
    const statusTexts = {
      'pending': 'Chờ xử lý',
      'confirmed': 'Đang xử lý',
      'processing': 'Đang xử lý',
      'shipped': 'Đang giao',
      'delivered': 'Đã giao',
      'cancelled': 'Đã hủy',
      'returned': 'Đã hoàn trả',
      'failed': 'Giao hàng thất bại'
    }
    return statusTexts[status] || 'Không xác định'
  }

  const getOrderStatusColor = (status) => {
    const statusColors = {
      'pending': 'yellow',
      'confirmed': 'purple', // unified with processing
      'processing': 'purple',
      'shipped': 'indigo',
      'delivered': 'green',
      'cancelled': 'red',
      'returned': 'orange',
      'failed': 'red'
    }
    return statusColors[status] || 'gray'
  }

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND'
    }).format(amount || 0)
  }

  const formatDate = (date) => {
    return new Date(date).toLocaleString('vi-VN', {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit'
    })
  }

  const calculateDistance = (lat1, lon1, lat2, lon2) => {
    const R = 6371 // Radius of the Earth in km
    const dLat = (lat2 - lat1) * Math.PI / 180
    const dLon = (lon2 - lon1) * Math.PI / 180
    const a = 
      Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
      Math.sin(dLon/2) * Math.sin(dLon/2)
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))
    const distance = R * c // Distance in km
    return distance
  }

  return {
    // State
    orders,
    currentOrder,
    loading,
    stats,
    
    // Computed
    recentOrders,
    processingOrders,
    pendingOrders,
    
    // Actions
    fetchOrders,
    fetchOrder,
    addOrder,
    updateOrder,
    updateOrderLocation,
    updateOrderStatus,
    updateOrderStatusWithImage,
    acceptOrder,
    startDelivery,
    startDeliveryWithImage,
    completeDelivery,
    cancelOrder,
    returnToWarehouse,
    getOrderStatusText,
    getOrderStatusColor,
    formatCurrency,
    formatDate,
    calculateDistance
  }
}) 