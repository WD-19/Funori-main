<template>
  <div class="space-y-6">
    <!-- Sticky Top Search Bar for Shipper (Mobile only) -->
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
      </div>
    </div>
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-sm p-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            Chào mừng, {{ user?.name }}! 👋
          </h1>
          <p class="text-gray-600 mt-1">
            {{ getGreeting() }} - Hôm nay bạn có {{ stats.today_orders }} đơn hàng cần xử lý
          </p>
        </div>
        <div class="text-right">
          <div class="text-sm text-gray-500">Trạng thái</div>
          <div class="flex items-center mt-1">
            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
            <span class="text-sm font-medium text-green-600">Đang hoạt động</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Tổng đơn hàng</p>
            <p class="text-2xl font-semibold text-gray-900">{{ stats.total_orders }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Đang xử lý</p>
            <p class="text-2xl font-semibold text-gray-900">{{ stats.processing_orders }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Đã giao</p>
            <p class="text-2xl font-semibold text-gray-900">{{ stats.delivered_orders }}</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Thu nhập</p>
            <p class="text-2xl font-semibold text-gray-900">{{ formatCurrency(stats.total_earnings) }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- All Orders -->
    <div class="bg-white rounded-lg shadow-sm">
      <!-- Desktop toolbar filters -->
      <div class="hidden md:block px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between gap-3">
          <h3 class="text-lg font-medium text-gray-900 whitespace-nowrap">Tất cả đơn hàng ({{ filteredOrders.length }})</h3>
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
      
              <div class="divide-y divide-gray-200">
           <div v-for="order in paginatedOrders" :key="order.id" class="px-6 py-4 hover:bg-gray-50">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                </div>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-900">
                  #{{ order.order_code }}
                </p>
                <p class="text-sm text-gray-500">
                  {{ order.user?.name }} <span v-if="order.user?.phone">• {{ order.user?.phone }}</span>
                </p>
                <p class="text-xs text-gray-400 truncate max-w-[260px] md:max-w-none">
                  {{ order.shipping_address }}
                </p>
              </div>
            </div>
            <div class="flex items-center space-x-4">
              <span :class="getStatusClasses(order.order_status)" class="px-2 py-1 text-xs font-medium rounded-full">
                {{ getStatusText(order.order_status) }}
              </span>
              <router-link :to="`/orders/${order.id}`" class="text-blue-600 hover:text-blue-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </router-link>
            </div>
          </div>
        </div>
        
        <!-- Pagination -->
        <div v-if="totalPages > 1" class="px-6 py-4 border-t border-gray-200">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
              Hiển thị {{ (currentPage - 1) * itemsPerPage + 1 }} - {{ Math.min(currentPage * itemsPerPage, filteredOrders.length) }} 
              trong tổng số {{ filteredOrders.length }} đơn hàng
            </div>
            <div class="flex space-x-2">
              <button 
                @click="currentPage = Math.max(1, currentPage - 1)"
                :disabled="currentPage === 1"
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Trước
              </button>
              
              <div class="flex space-x-1">
                <button 
                  v-for="page in getVisiblePages()" 
                  :key="page"
                  @click="currentPage = page"
                  :class="[
                    'px-3 py-1 text-sm border rounded-md',
                    page === currentPage 
                      ? 'bg-blue-600 text-white border-blue-600' 
                      : 'border-gray-300 hover:bg-gray-50'
                  ]"
                >
                  {{ page }}
                </button>
              </div>
              
              <button 
                @click="currentPage = Math.min(totalPages, currentPage + 1)"
                :disabled="currentPage === totalPages"
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Sau
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

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Hành động nhanh</h3>
        <div class="space-y-3">
          <button @click="refreshOrders" class="w-full flex items-center justify-between p-3 text-left text-gray-700 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
              <span>Cập nhật đơn hàng</span>
            </div>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
          
          <router-link to="/map" class="w-full flex items-center justify-between p-3 text-left text-gray-700 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
              </svg>
              <span>Xem bản đồ</span>
            </div>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </router-link>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Thông báo</h3>
        <div v-if="notifications.length > 0" class="space-y-3">
          <div v-for="notification in notifications.slice(0, 3)" :key="notification.id" class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-900">{{ notification.message }}</p>
              <p class="text-xs text-gray-500 mt-1">{{ formatTime(notification.created_at) }}</p>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-4">
          <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
          </svg>
          <p class="text-sm text-gray-500 mt-2">Không có thông báo mới</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useOrderStore } from '../stores/orders'
import { useNotificationStore } from '../stores/notifications'

// Stores
const authStore = useAuthStore()
const orderStore = useOrderStore()
const notificationStore = useNotificationStore()

// Reactive data
const loading = ref(false)
const searchQuery = ref('')
// statusFilter supports: '', 'shipped', 'delivered', 'failed'
const statusFilter = ref('')
const dateFilter = ref('today') // today | yesterday | last7 | range
const customDateRange = ref({ start: '', end: '' })
const areaFilter = ref('')
const areas = ref([])
const showFilterSheet = ref(false)

const currentPage = ref(1)
const itemsPerPage = ref(10)

// Computed
const user = computed(() => authStore.user)
const stats = computed(() => orderStore.stats)
const orders = computed(() => orderStore.orders)
const notifications = computed(() => notificationStore.notifications)

const filteredOrders = computed(() => {
  let filtered = orders.value

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(order => 
      order.order_code?.toLowerCase().includes(query) ||
      order.user?.name?.toLowerCase().includes(query) ||
      order.user?.phone?.toLowerCase?.()?.includes(query) ||
      order.shipping_phone?.toLowerCase?.()?.includes(query) ||
      order.shipping_address?.toLowerCase().includes(query)
    )
  }

  // Filter by status
  if (statusFilter.value) {
    if (statusFilter.value === 'failed') {
      filtered = filtered.filter(order => ['cancelled', 'returned', 'failed'].includes(order.order_status))
    } else {
      filtered = filtered.filter(order => order.order_status === statusFilter.value)
    }
  }

  // Filter by date
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
  filtered = filtered.filter(isWithinDate)

  // Filter by area
  if (areaFilter.value) {
    const areaQuery = areaFilter.value.toLowerCase()
    filtered = filtered.filter(order => order.shipping_address?.toLowerCase().includes(areaQuery))
  }

  return filtered
})

const paginatedOrders = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filteredOrders.value.slice(start, end)
})

const totalPages = computed(() => {
  return Math.ceil(filteredOrders.value.length / itemsPerPage.value)
})

// Methods
const getGreeting = () => {
  const hour = new Date().getHours()
  if (hour < 12) return 'Buổi sáng tốt lành'
  if (hour < 18) return 'Buổi chiều tốt lành'
  return 'Buổi tối tốt lành'
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
  }).format(amount || 0)
}

const getStatusText = (status) => {
  const texts = {
    'pending': 'Chờ xác nhận',
    'confirmed': 'Đã xác nhận',
    'processing': 'Đang xử lý',
    'shipped': 'Đang giao',
    'delivered': 'Thành công',
    'failed': 'Thất bại',
    'cancelled': 'Đã hủy',
    'returned': 'Hoàn trả'
  }
  return texts[status] || status
}

const getStatusClasses = (status) => {
  const classes = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'confirmed': 'bg-blue-100 text-blue-800',
    'processing': 'bg-purple-100 text-purple-800',
    'shipped': 'bg-blue-100 text-blue-800',
    'delivered': 'bg-green-100 text-green-800',
    'failed': 'bg-orange-100 text-orange-800',
    'cancelled': 'bg-red-100 text-red-800',
    'returned': 'bg-orange-100 text-orange-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const formatTime = (time) => {
  return new Date(time).toLocaleString('vi-VN', {
    hour: '2-digit',
    minute: '2-digit',
    day: '2-digit',
    month: '2-digit'
  })
}

const refreshOrders = async () => {
  try {
    await orderStore.fetchOrders()
  } catch (error) {
    console.error('Error refreshing orders:', error)
  }
}

// Filter helpers / UI handlers
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
  currentPage.value = 1
}

const clearSearch = () => {
  searchQuery.value = ''
}

const applyFilters = () => {
  // Filters are reactive; just close the sheet
  currentPage.value = 1
  showFilterSheet.value = false
}

const closeFilterSheet = () => {
  showFilterSheet.value = false
}

const onApplyFilters = () => {
  currentPage.value = 1
}

const activeFilterChips = computed(() => {
  const chips = []
  if (statusFilter.value) {
    const opt = statusOptions.find(o => o.value === statusFilter.value)
    if (opt) chips.push({ label: opt.label, class: opt.activeClass })
  }
  const dateOpt = dateOptions.find(d => d.value === dateFilter.value)
  if (dateOpt) {
    if (dateFilter.value === 'range' && customDateRange.value.start && customDateRange.value.end) {
      chips.push({ label: `${customDateRange.value.start} → ${customDateRange.value.end}`, class: 'bg-gray-100 text-gray-800' })
    } else {
      chips.push({ label: dateOpt.label, class: 'bg-gray-100 text-gray-800' })
    }
  }
  if (areaFilter.value) chips.push({ label: areaFilter.value, class: 'bg-gray-100 text-gray-800' })
  return chips
})

const getVisiblePages = () => {
  const pages = []
  const maxVisible = 5
  
  if (totalPages.value <= maxVisible) {
    // Show all pages if total is small
    for (let i = 1; i <= totalPages.value; i++) {
      pages.push(i)
    }
  } else {
    // Show smart pagination
    if (currentPage.value <= 3) {
      // Near start
      for (let i = 1; i <= 4; i++) {
        pages.push(i)
      }
      pages.push('...')
      pages.push(totalPages.value)
    } else if (currentPage.value >= totalPages.value - 2) {
      // Near end
      pages.push(1)
      pages.push('...')
      for (let i = totalPages.value - 3; i <= totalPages.value; i++) {
        pages.push(i)
      }
    } else {
      // Middle
      pages.push(1)
      pages.push('...')
      for (let i = currentPage.value - 1; i <= currentPage.value + 1; i++) {
        pages.push(i)
      }
      pages.push('...')
      pages.push(totalPages.value)
    }
  }
  
  return pages
}

// Watchers
watch([searchQuery, statusFilter, dateFilter, () => customDateRange.value.start, () => customDateRange.value.end, areaFilter], () => {
  currentPage.value = 1 // Reset to first page when filters change
})

// Lifecycle
onMounted(async () => {
  try {
    loading.value = true
    await Promise.all([
      orderStore.fetchOrders(),
      notificationStore.fetchNotifications()
    ])
    // Load areas from static data if available
    try {
      const res = await fetch('/data/hanoi-districts.json')
      if (res.ok) {
        const data = await res.json()
        const names = Array.isArray(data)
          ? data.map(d => d.name)
          : (data?.districts || []).map(d => d.name)
        areas.value = Array.from(new Set(names.filter(Boolean)))
      }
    } catch (e) {
      // ignore if not available
    }
  } catch (error) {
    console.error('Dashboard initialization error:', error)
  } finally {
    loading.value = false
  }
})

onUnmounted(() => {
  // Cleanup if needed
})
</script> 