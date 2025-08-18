<template>
  <div class="space-y-6">
    <!-- Sticky Top Search Bar (Mobile only) -->
    <div class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b md:hidden">
      <div class="px-4 py-3 flex items-center space-x-3">
        <div class="flex-1 flex items-center bg-gray-100 rounded-full px-3">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
          </svg>
          <input
            v-model.trim="searchQuery"
            type="search"
            inputmode="search"
            placeholder="Nhập mã đơn hoặc SĐT khách..."
            class="w-full bg-transparent border-0 focus:ring-0 px-2 py-2 text-sm"
            @keyup.enter="onApplyFilters"
          />
          <button v-if="searchQuery" @click="clearSearch" class="text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <button @click="showFilterSheet = true" class="shrink-0 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M7 12h10M10 20h4" />
          </svg>
        </button>
        <button @click="refreshOrders" class="shrink-0 w-10 h-10 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="text-center py-8">
      <div class="loading-spinner w-8 h-8 mx-auto mb-4"></div>
      <p class="text-gray-600">Đang tải đơn hàng...</p>
    </div>

    <!-- Orders List -->
    <div v-else-if="filteredOrders.length > 0" class="space-y-4">
      <!-- Desktop toolbar filters -->
      <div class="hidden md:block bg-white rounded-lg shadow-sm p-4">
        <div class="flex items-center justify-between gap-3">
          <h2 class="text-lg font-medium text-gray-900 whitespace-nowrap">Bộ lọc</h2>
          <div class="flex-1 flex items-center justify-end gap-3">
            <div class="flex items-center bg-gray-100 rounded-lg px-3 w-72">
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
              </svg>
              <input v-model.trim="searchQuery" type="search" placeholder="Mã đơn/SĐT" class="w-full bg-transparent border-0 focus:ring-0 px-2 py-1 text-sm" />
            </div>
            <select v-model="statusFilter" class="px-3 py-2 border rounded-lg text-sm">
              <option value="">Tất cả</option>
              <option value="shipped">Đang giao</option>
              <option value="delivered">Thành công</option>
              <option value="failed">Thất bại</option>
            </select>
            <select v-model="dateFilter" class="px-3 py-2 border rounded-lg text-sm">
              <option value="today">Hôm nay</option>
              <option value="yesterday">Hôm qua</option>
              <option value="last7">7 ngày</option>
              <option value="range">Khoảng ngày</option>
            </select>
            <div v-if="dateFilter === 'range'" class="flex items-center gap-2">
              <input type="date" v-model="customDateRange.start" class="px-2 py-1 border rounded-lg text-sm" />
              <span class="text-gray-400">→</span>
              <input type="date" v-model="customDateRange.end" class="px-2 py-1 border rounded-lg text-sm" />
            </div>
            <select v-model="areaFilter" class="px-3 py-2 border rounded-lg text-sm w-48">
              <option value="">Tất cả KV</option>
              <option v-for="a in areas" :key="a" :value="a">{{ a }}</option>
            </select>
            <button @click="applyFilters" class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">Áp dụng</button>
            <button @click="clearFilters" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">Xóa</button>
          </div>
        </div>
      </div>
      <!-- Stats Summary -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="text-center">
            <div class="text-2xl font-bold text-blue-600">{{ filteredOrders.length }}</div>
            <div class="text-sm text-gray-600">Tổng đơn hàng</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-yellow-600">{{ getOrdersByStatus('processing').length }}</div>
            <div class="text-sm text-gray-600">Đang xử lý</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-green-600">{{ getOrdersByStatus('delivered').length }}</div>
            <div class="text-sm text-gray-600">Đã giao</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-red-600">{{ getOrdersByStatus('cancelled').length }}</div>
            <div class="text-sm text-gray-600">Đã hủy</div>
          </div>
        </div>
      </div>

      <!-- Orders Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="order in filteredOrders" :key="order.id" class="bg-white rounded-lg shadow-sm">
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                  <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">#{{ order.order_code }}</p>
                  <p class="text-xs text-gray-500">{{ formatDate(order.created_at) }}</p>
                </div>
              </div>
              <span :class="getStatusClasses(order.order_status)" class="status-badge text-xs">
                {{ getStatusText(order.order_status) }}
              </span>
            </div>
            
            <div class="space-y-2">
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Khách hàng:</span>
                <span class="font-medium">{{ order.user?.name || 'N/A' }}</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Tổng tiền:</span>
                <span class="font-semibold text-green-600">{{ formatCurrency(order.total_amount) }}</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Địa chỉ:</span>
                <span class="text-xs text-gray-500 truncate max-w-32">{{ order.shipping_address }}</span>
              </div>
            </div>
            
            <div class="mt-4 flex justify-between">
              <router-link :to="`/orders/${order.id}`" class="text-blue-600 hover:text-blue-500 text-sm">
                Xem chi tiết →
              </router-link>
            </div>
          </div>
          
          <!-- Quick Actions -->
          <div v-if="canUpdateStatus(order.order_status)" class="px-4 pb-4">
            <div class="flex flex-wrap gap-2">
              <button
                v-if="order.order_status === 'confirmed'"
                @click="updateStatus(order.id, 'processing')"
                class="btn-primary text-xs"
              >
                Nhận đơn hàng
              </button>
              
              <button
                v-if="order.order_status === 'processing'"
                @click="updateStatus(order.id, 'shipped')"
                class="btn-primary text-xs"
              >
                Bắt đầu giao
              </button>
              
              <button
                v-if="order.order_status === 'shipped'"
                @click="showDeliveryModal(order)"
                class="btn-success text-xs"
              >
                Hoàn thành
              </button>
              
              <button
                v-if="['processing', 'shipped'].includes(order.order_status)"
                @click="showCancelModal(order)"
                class="btn-danger text-xs"
              >
                Hủy đơn
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div v-else class="text-center py-12">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">Không có đơn hàng</h3>
      <p class="mt-1 text-sm text-gray-500">
        {{ searchQuery || statusFilter ? 'Không tìm thấy đơn hàng phù hợp' : 'Bạn chưa có đơn hàng nào' }}
      </p>
    </div>

    <!-- Delivery Modal -->
    <div v-if="showDeliveryForm" class="modal-overlay" @click="closeDeliveryModal">
      <div class="modal-content" @click.stop>
        <div class="p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Hoàn thành giao hàng</h3>
          
          <div class="space-y-4">
            <div>
              <label class="form-label">Ghi chú giao hàng</label>
              <textarea
                v-model="deliveryNotes"
                rows="3"
                class="form-input"
                placeholder="Nhập ghi chú về việc giao hàng..."
              ></textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
              <button @click="closeDeliveryModal" class="btn-secondary">
                Hủy
              </button>
              <button @click="completeDelivery" class="btn-success">
                Hoàn thành
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cancel Modal -->
    <div v-if="showCancelForm" class="modal-overlay" @click="closeCancelModal">
      <div class="modal-content" @click.stop>
        <div class="p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Hủy đơn hàng</h3>
          
          <div class="space-y-4">
            <div>
              <label class="form-label">Lý do hủy</label>
              <textarea
                v-model="cancelReason"
                rows="3"
                class="form-input"
                placeholder="Nhập lý do hủy đơn hàng..."
              ></textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
              <button @click="closeCancelModal" class="btn-secondary">
                Hủy
              </button>
              <button @click="cancelOrder" class="btn-danger">
                Xác nhận hủy
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Sheet Filters -->
    <div v-if="showFilterSheet" class="fixed inset-0 z-40">
      <div class="absolute inset-0 bg-black/40" @click="closeFilterSheet"></div>
      <div class="absolute inset-x-0 bottom-0 bg-white rounded-t-2xl shadow-xl p-4 pb-6 max-h-[80vh] overflow-y-auto">
        <div class="w-14 h-1.5 bg-gray-300 rounded-full mx-auto mb-4"></div>
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-base font-semibold text-gray-900">Bộ lọc</h3>
          <button @click="closeFilterSheet" class="p-2 text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Status -->
        <div class="mb-4">
          <div class="text-sm font-medium text-gray-700 mb-2">Trạng thái đơn hàng</div>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="opt in statusOptions" :key="opt.value"
              @click="toggleStatus(opt.value)"
              :class="['px-3 py-1.5 rounded-full text-sm font-medium', statusFilter === opt.value ? opt.activeClass : 'bg-gray-100 text-gray-700']"
            >
              <span class="inline-flex items-center">
                <span :class="['w-2 h-2 rounded-full mr-2', opt.dotClass]"></span>{{ opt.label }}
              </span>
            </button>
          </div>
        </div>

        <!-- Date -->
        <div class="mb-4">
          <div class="text-sm font-medium text-gray-700 mb-2">Ngày giao</div>
          <div class="grid grid-cols-2 gap-2 mb-3">
            <button v-for="d in dateOptions" :key="d.value" @click="selectDatePreset(d.value)"
              :class="['px-3 py-2 rounded-lg text-sm', dateFilter === d.value ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800']">
              {{ d.label }}
            </button>
          </div>
          <div v-if="dateFilter === 'range'" class="grid grid-cols-2 gap-2">
            <input type="date" v-model="customDateRange.start" class="px-3 py-2 border rounded-lg text-sm" />
            <input type="date" v-model="customDateRange.end" class="px-3 py-2 border rounded-lg text-sm" />
          </div>
        </div>

        <!-- Area -->
        <div class="mb-4">
          <div class="text-sm font-medium text-gray-700 mb-2">Khu vực/Tuyến giao</div>
          <select v-model="areaFilter" class="w-full px-3 py-2 border rounded-lg text-sm">
            <option value="">Tất cả khu vực</option>
            <option v-for="a in areas" :key="a" :value="a">{{ a }}</option>
          </select>
        </div>

        <div class="flex items-center gap-3 mt-6">
          <button @click="applyFilters" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">Áp dụng lọc</button>
          <button @click="clearFilters" class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium">Xóa lọc</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useOrderStore } from '../stores/orders'

// Store
const orderStore = useOrderStore()

// Reactive data
const loading = ref(false)
const searchQuery = ref('')
const statusFilter = ref('') // shipped | delivered | failed
const dateFilter = ref('today') // today | yesterday | last7 | range
const customDateRange = ref({ start: '', end: '' })
const areaFilter = ref('')
const areas = ref([])
const showFilterSheet = ref(false)
const showDeliveryForm = ref(false)
const showCancelForm = ref(false)
const selectedOrder = ref(null)
const deliveryNotes = ref('')
const cancelReason = ref('')

// Computed
const filteredOrders = computed(() => {
  let list = orderStore.orders

  // Search by code, name, phone, address
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    list = list.filter(order =>
      order.order_code?.toLowerCase().includes(query) ||
      order.user?.name?.toLowerCase().includes(query) ||
      order.user?.phone?.toLowerCase?.()?.includes(query) ||
      order.shipping_phone?.toLowerCase?.()?.includes(query) ||
      order.shipping_address?.toLowerCase().includes(query)
    )
  }

  // Status
  if (statusFilter.value) {
    if (statusFilter.value === 'failed') {
      list = list.filter(order => ['cancelled', 'returned', 'failed'].includes(order.order_status))
    } else {
      list = list.filter(order => order.order_status === statusFilter.value)
    }
  }

  // Date
  const isWithinDate = (order) => {
    const pickDateStr = order.delivered_at || order.shipped_at || order.processing_at || order.created_at || order.ordered_at || order.updated_at
    if (!pickDateStr) return true
    const d = new Date(pickDateStr)
    const today = new Date()
    const startOfDay = (date) => new Date(date.getFullYear(), date.getMonth(), date.getDate())
    const endOfDay = (date) => new Date(date.getFullYear(), date.getMonth(), date.getDate(), 23, 59, 59, 999)

    if (dateFilter.value === 'today') {
      return d >= startOfDay(today) && d <= endOfDay(today)
    }
    if (dateFilter.value === 'yesterday') {
      const y = new Date(today)
      y.setDate(y.getDate() - 1)
      return d >= startOfDay(y) && d <= endOfDay(y)
    }
    if (dateFilter.value === 'last7') {
      const seven = new Date(today)
      seven.setDate(seven.getDate() - 6)
      return d >= startOfDay(seven) && d <= endOfDay(today)
    }
    if (dateFilter.value === 'range') {
      if (!customDateRange.value.start || !customDateRange.value.end) return true
      const s = new Date(customDateRange.value.start)
      const e = new Date(customDateRange.value.end)
      return d >= startOfDay(s) && d <= endOfDay(e)
    }
    return true
  }
  list = list.filter(isWithinDate)

  // Area
  if (areaFilter.value) {
    const areaQuery = areaFilter.value.toLowerCase()
    list = list.filter(order => order.shipping_address?.toLowerCase().includes(areaQuery))
  }

  return list
})

// Methods
const getOrdersByStatus = (status) => {
  return orderStore.orders.filter(order => order.order_status === status)
}

const refreshOrders = async () => {
  try {
    loading.value = true
    await orderStore.fetchOrders()
  } catch (error) {
    console.error('Error refreshing orders:', error)
  } finally {
    loading.value = false
  }
}

const updateStatus = async (orderId, status) => {
  try {
    const result = await orderStore.updateOrderStatus(orderId, status)
    if (result.success) {
      console.log('Status updated successfully')
    } else {
      console.error('Failed to update status:', result.message)
    }
  } catch (error) {
    console.error('Error updating status:', error)
  }
}

const showDeliveryModal = (order) => {
  selectedOrder.value = order
  deliveryNotes.value = ''
  showDeliveryForm.value = true
}

const closeDeliveryModal = () => {
  showDeliveryForm.value = false
  selectedOrder.value = null
  deliveryNotes.value = ''
}

const completeDelivery = async () => {
  if (!selectedOrder.value) return
  
  try {
    const result = await orderStore.completeDelivery(
      selectedOrder.value.id, 
      deliveryNotes.value
    )
    
    if (result.success) {
      closeDeliveryModal()
      console.log('Delivery completed successfully')
    } else {
      console.error('Failed to complete delivery:', result.message)
    }
  } catch (error) {
    console.error('Error completing delivery:', error)
  }
}

const showCancelModal = (order) => {
  selectedOrder.value = order
  cancelReason.value = ''
  showCancelForm.value = true
}

const closeCancelModal = () => {
  showCancelForm.value = false
  selectedOrder.value = null
  cancelReason.value = ''
}

const cancelOrder = async () => {
  if (!selectedOrder.value || !cancelReason.value) return
  
  try {
    const result = await orderStore.cancelOrder(
      selectedOrder.value.id, 
      cancelReason.value
    )
    
    if (result.success) {
      closeCancelModal()
      console.log('Order cancelled successfully')
    } else {
      console.error('Failed to cancel order:', result.message)
    }
  } catch (error) {
    console.error('Error cancelling order:', error)
  }
}

const canUpdateStatus = (status) => {
  return ['confirmed', 'processing', 'shipped'].includes(status)
}

const getStatusClasses = (status) => {
  const classes = {
    'pending': 'status-pending',
    'confirmed': 'status-confirmed',
    'processing': 'status-processing',
    'shipped': 'status-shipped',
    'delivered': 'status-delivered',
    'failed': 'status-failed',
    'cancelled': 'status-cancelled'
  }
  return classes[status] || 'status-pending'
}

const getStatusText = (status) => {
  const texts = {
    'pending': 'Chờ xử lý',
    'confirmed': 'Đã xác nhận',
    'processing': 'Đang xử lý',
    'shipped': 'Đang giao',
    'delivered': 'Thành công',
    'failed': 'Thất bại',
    'cancelled': 'Đã hủy'
  }
  return texts[status] || status
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
  }).format(amount || 0)
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('vi-VN')
}

// Lifecycle
onMounted(async () => {
  await refreshOrders()
  // Load areas if available
  try {
    const res = await fetch('/data/hanoi-districts.json')
    if (res.ok) {
      const data = await res.json()
      const names = Array.isArray(data)
        ? data.map(d => d.name)
        : (data?.districts || []).map(d => d.name)
      areas.value = Array.from(new Set(names.filter(Boolean)))
    }
  } catch (e) {}
})

// Filter helpers
const statusOptions = [
  { value: 'shipped', label: 'Đang giao', activeClass: 'bg-blue-100 text-blue-800', dotClass: 'bg-blue-500' },
  { value: 'delivered', label: 'Thành công', activeClass: 'bg-green-100 text-green-800', dotClass: 'bg-green-500' },
  { value: 'failed', label: 'Thất bại', activeClass: 'bg-orange-100 text-orange-800', dotClass: 'bg-orange-500' }
]

const dateOptions = [
  { value: 'today', label: 'Hôm nay' },
  { value: 'yesterday', label: 'Hôm qua' },
  { value: 'last7', label: '7 ngày gần nhất' },
  { value: 'range', label: 'Chọn khoảng ngày' }
]

const toggleStatus = (val) => {
  statusFilter.value = statusFilter.value === val ? '' : val
}

const selectDatePreset = (val) => {
  dateFilter.value = val
}

const clearFilters = () => {
  statusFilter.value = ''
  dateFilter.value = 'today'
  customDateRange.value = { start: '', end: '' }
  areaFilter.value = ''
}

const clearSearch = () => {
  searchQuery.value = ''
}

const applyFilters = () => {
  showFilterSheet.value = false
}

const closeFilterSheet = () => {
  showFilterSheet.value = false
}

const onApplyFilters = () => {}

watch([searchQuery, statusFilter, dateFilter, () => customDateRange.value.start, () => customDateRange.value.end, areaFilter], () => {
  // reactive filters
})
</script> 