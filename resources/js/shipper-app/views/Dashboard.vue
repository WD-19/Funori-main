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
          <div class="flex items-center mt-1 space-x-3">
            <div class="flex items-center">
              <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
              <span class="text-sm font-medium text-green-600">Đang hoạt động</span>
            </div>
            <!-- WebSocket Status -->
            <div class="flex items-center">
              <div :class="[
                'w-2 h-2 rounded-full mr-2',
                websocketStatus === 'connected' ? 'bg-green-500' : 
                websocketStatus === 'connecting' ? 'bg-yellow-500' : 'bg-red-500'
              ]"></div>
              <span :class="[
                'text-sm font-medium',
                websocketStatus === 'connected' ? 'text-green-600' : 
                websocketStatus === 'connecting' ? 'text-yellow-600' : 'text-red-600'
              ]">
                {{ websocketStatus === 'connected' ? 'Realtime' : 
                   websocketStatus === 'connecting' ? 'Đang kết nối' : 'Mất kết nối' }}
              </span>
            </div>
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
          <div class="flex-1 flex items-center justify-end gap-3 flex-wrap">
            <!-- Search Bar -->
            <div class="flex items-center bg-gray-100 rounded-lg px-3 w-64">
              <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
              </svg>
              <input v-model.trim="searchQuery" type="search" placeholder="Mã đơn/SĐT" class="w-full bg-transparent border-0 focus:ring-0 px-2 py-2 text-sm" />
            </div>
            
            <!-- Status Filter -->
            <select v-model="statusFilter" class="px-3 py-2 border rounded-lg text-sm min-w-[120px]">
              <option value="">Tất cả</option>
              <option value="shipped">Đang giao</option>
              <option value="delivered">Thành công</option>
              <option value="failed">Thất bại</option>
            </select>
            
            <!-- Date Filter -->
            <select v-model="dateFilter" class="px-3 py-2 border rounded-lg text-sm min-w-[120px]">
              <option value="today">Hôm nay</option>
              <option value="yesterday">Hôm qua</option>
              <option value="last7">7 ngày</option>
              <option value="range">Khoảng ngày</option>
            </select>
            
            <!-- Custom Date Range -->
            <div v-if="dateFilter === 'range'" class="flex items-center gap-2 min-w-[200px]">
              <input type="date" v-model="customDateRange.start" class="px-2 py-2 border rounded-lg text-sm w-24" />
              <span class="text-gray-400 text-sm">→</span>
              <input type="date" v-model="customDateRange.end" class="px-2 py-2 border rounded-lg text-sm w-24" />
            </div>
            
            <!-- Area Filter -->
            <div class="relative min-w-[180px] area-filter-container">
              <button 
                type="button"
                class="w-full px-3 py-2 border rounded-lg text-sm text-left bg-white flex items-center justify-between"
                @click="showAreaDropdown = !showAreaDropdown"
              >
                <span>{{ areaFilter || 'Tất cả KV Hà Nội' }}</span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <!-- Area Search Popup -->
              <div v-if="showAreaDropdown" class="absolute top-full left-0 right-0 mt-1 bg-white border rounded-lg shadow-lg z-10 max-h-60 overflow-y-auto">
                <div class="p-3">
                  <div class="mb-3">
                    <input 
                      v-model.trim="areaSearchQuery"
                      type="text" 
                      placeholder="Tìm kiếm khu vực Hà Nội..."
                      class="w-full px-3 py-2 border rounded-lg text-sm"
                      @click.stop
                    />
                  </div>
                  
                  <!-- Quick Districts -->
                  <!-- Thay đổi từ "Quận/Huyện chính" thành "Phường/Xã nổi bật" -->
                  <div v-if="!areaSearchQuery" class="mb-3">
                    <div class="text-xs text-gray-600 mb-2 font-medium">Phường/Xã nổi bật:</div>
                    <div class="grid grid-cols-2 gap-2">
                      <button
                        v-for="area in areas.slice(0, 8)" 
                        :key="area"
                        @click="areaFilter = area; showAreaDropdown = false"
                        class="px-2 py-1 text-xs rounded border border-gray-300 bg-gray-50 text-gray-700 hover:bg-gray-100 text-center"
                      >
                        {{ area }}
                      </button>
                    </div>
                  </div>
                  
                  <!-- Search Results -->
                  <div class="space-y-1">
                    <div 
                      v-for="area in filteredAreas.slice(0, 50)" 
                      :key="area"
                      @click="areaFilter = area; showAreaDropdown = false"
                      class="px-3 py-2 hover:bg-gray-100 rounded cursor-pointer text-sm border-b border-gray-100 last:border-b-0"
                    >
                      {{ area }}
                    </div>
                    
                    <!-- Show more indicator -->
                    <div v-if="filteredAreas.length > 50" class="px-3 py-2 text-xs text-gray-500 text-center">
                      Và {{ filteredAreas.length - 50 }} khu vực khác...
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2 flex-shrink-0">
              <button @click="applyFilters" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                Áp dụng
              </button>
              <button @click="clearFilters" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                Xóa
              </button>
            </div>
          </div>
        </div>
        
        <!-- Active Filters Display -->
        <div v-if="hasActiveFilters" class="mt-4 pt-3 border-t border-gray-200">
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-sm text-gray-600 font-medium">Bộ lọc đang hoạt động:</span>
            
            <!-- Status Filter -->
            <span v-if="statusFilter" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
              {{ getStatusText(statusFilter) }}
              <button @click="statusFilter = ''" class="ml-2 text-blue-600 hover:text-blue-800 font-bold">×</button>
            </span>
            
            <!-- Date Filter -->
            <span v-if="dateFilter && dateFilter !== 'today'" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
              {{ getDateFilterText() }}
              <button @click="dateFilter = 'today'" class="ml-2 text-green-600 hover:text-green-800 font-bold">×</button>
            </span>
            
            <!-- Area Filter -->
            <span v-if="areaFilter" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
              {{ areaFilter }}
              <button @click="areaFilter = ''" class="ml-2 text-purple-600 hover:text-purple-800 font-bold">×</button>
            </span>
            
            <!-- Search Query -->
            <span v-if="searchQuery" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
              "{{ searchQuery }}"
              <button @click="searchQuery = ''" class="ml-2 text-orange-600 hover:text-orange-800 font-bold">×</button>
            </span>
            
            <!-- Clear All Button -->
            <button @click="clearFilters" class="text-sm text-gray-500 hover:text-gray-700 underline font-medium">
              Xóa tất cả
            </button>
          </div>
        </div>
      </div>
      
              <div class="divide-y divide-gray-200">
        <!-- Desktop Order Display -->
        <div v-for="order in paginatedOrders" :key="order.id" class="px-6 py-4 hover:bg-gray-50 hidden md:block">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4 flex-1">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-3 mb-1">
                  <p class="text-lg font-semibold text-gray-900">
                  #{{ order.order_code }}
                </p>
                  <span :class="getStatusClasses(order.order_status)" class="px-3 py-1 text-xs font-medium rounded-full">
                    {{ getStatusText(order.order_status) }}
                  </span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                  <div>
                    <p class="text-gray-600 mb-1">
                      <span class="font-medium">Khách hàng:</span> {{ order.shipping_name || order.user?.full_name || 'N/A' }}
                    </p>
                    <p class="text-gray-500">
                      <span class="font-medium">SĐT:</span> {{ order.shipping_phone || order.user?.phone_number || 'N/A' }}
                </p>
              </div>
                  <div>
                    <p class="text-gray-600 mb-1">
                      <span class="font-medium">Địa chỉ:</span> {{ order.shipping_address || 'N/A' }}
                    </p>
                    <p class="text-gray-500">
                      <span class="font-medium">Tổng tiền:</span> {{ formatCurrency(order.total_amount) }}
                    </p>
            </div>
                </div>
                <div class="mt-2 text-xs text-gray-400">
                  <span class="font-medium">Ngày tạo:</span> {{ formatTime(order.created_at) }}
                </div>
              </div>
            </div>
            <div class="flex items-center space-x-3 ml-4">
              <router-link :to="`/orders/${order.id}`" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                Xem chi tiết
              </router-link>
            </div>
          </div>
        </div>

        <!-- Mobile Order Display -->
        <div v-for="order in paginatedOrders" :key="`mobile-${order.id}`" class="px-4 py-3 hover:bg-gray-50 md:hidden border-b border-gray-100">
          <div class="space-y-3">
            <!-- Order Header with Status -->
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                  <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-base font-bold text-gray-900">
                    #{{ order.order_code }}
                  </p>
                  <p class="text-xs text-gray-500">
                    {{ formatTime(order.created_at) }}
                  </p>
                </div>
              </div>
              <span :class="getStatusClasses(order.order_status)" class="px-3 py-1 text-xs font-medium rounded-full">
                {{ getStatusText(order.order_status) }}
              </span>
            </div>

            <!-- Customer & Order Info -->
            <div class="bg-gray-50 rounded-lg p-3 space-y-2">
              <div class="flex items-center space-x-2">
                <span class="text-blue-600">👤</span>
                <span class="text-sm font-medium text-gray-900">{{ order.shipping_name || order.user?.full_name || 'N/A' }}</span>
                <span class="text-gray-400">•</span>
                <span class="text-sm text-gray-600">{{ order.shipping_phone || order.user?.phone_number || 'N/A' }}</span>
              </div>
              
              <div class="flex items-start space-x-2">
                <span class="text-green-600 mt-0.5">📍</span>
                <p class="text-sm text-gray-700 flex-1">{{ order.shipping_address || 'N/A' }}</p>
              </div>
              
              <div class="flex items-center justify-between pt-1">
                <span class="text-sm text-gray-600">
                  <span class="font-medium">Tổng tiền:</span> {{ formatCurrency(order.total_amount) }}
                </span>
                <router-link :to="`/orders/${order.id}`" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700 transition-colors">
                  Chi tiết →
              </router-link>
              </div>
            </div>
          </div>
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
          <div class="text-sm font-medium text-gray-700 mb-3">Khu vực (Phường xã Hà Nội)</div>
          
          <!-- Area Search -->
          <div class="mb-3">
            <input 
              v-model.trim="areaSearchQuery"
              type="text" 
              placeholder="🔍 Tìm kiếm phường xã"
              class="w-full px-3 py-2 border rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500"
            />
          </div>
          
          
          <!-- Quick District Selection -->
        <div class="mb-4">
          <div class="text-xs text-gray-600 mb-2 font-medium">📍 Phường/Xã nổi bật:</div>
          <div class="grid grid-cols-3 gap-2">
            <button
              v-for="area in areas.slice(0, 15)" 
              :key="area"
              @click="areaFilter = area"
              :class="[
                'px-2 py-2 text-xs rounded-lg border text-center transition-colors font-medium',
                areaFilter === area 
                  ? 'bg-blue-600 text-white border-blue-600 shadow-sm' 
                  : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-300'
              ]"
            >
              {{ area }}
            </button>
          </div>
  
  <!-- Show more areas if needed -->
  <div v-if="areas.length > 15" class="mt-3">
    <button
      @click="showAllAreas = !showAllAreas"
      class="w-full px-3 py-2 text-xs rounded-lg border border-gray-300 bg-gray-50 text-gray-700 hover:bg-gray-100 transition-colors"
    >
      <span v-if="!showAllAreas">
        📍 Xem thêm {{ areas.length - 15 }} phường/xã
      </span>
      <span v-else>�� Thu gọn</span>
    </button>
    
    <!-- Show all areas when expanded -->
    <div v-if="showAllAreas" class="mt-3 grid grid-cols-3 gap-2">
      <button
        v-for="area in areas.slice(15)" 
        :key="area"
        @click="areaFilter = area"
        :class="[
          'px-2 py-2 text-xs rounded-lg border text-center transition-colors font-medium',
          areaFilter === area 
            ? 'bg-blue-600 text-white border-blue-600 shadow-sm' 
            : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-50 hover:border-blue-300'
        ]"
      >
        {{ area }}
      </button>
    </div>
  </div>
</div>
          
          <!-- Area Selection List -->
          <div v-if="areaSearchQuery || areas.length <= 50" class="mb-3">
            <div class="text-xs text-gray-600 mb-2 font-medium">📋 Danh sách chi tiết:</div>
            <div class="max-h-32 overflow-y-auto border rounded-lg bg-gray-50">
              <div class="p-2">
                <label class="flex items-center p-2 hover:bg-white rounded cursor-pointer transition-colors">
                  <input 
                    type="radio" 
                    :value="''" 
                    v-model="areaFilter"
                    class="mr-2 text-blue-600"
                  />
                  <span class="text-sm font-medium">🌍 Tất cả khu vực Hà Nội</span>
                </label>
                
                <div v-for="area in filteredAreas.slice(0, 20)" :key="area" class="border-t border-gray-200">
                  <label class="flex items-center p-2 hover:bg-white rounded cursor-pointer transition-colors">
                    <input 
                      type="radio" 
                      :value="area" 
                      v-model="areaFilter"
                      class="mr-2 text-blue-600"
                    />
                    <span class="text-sm">{{ area }}</span>
                  </label>
                </div>
                
                <!-- Show more indicator -->
                <div v-if="filteredAreas.length > 20" class="p-2 text-center">
                  <span class="text-xs text-gray-500">
                    Và {{ filteredAreas.length - 20 }} khu vực khác...
                  </span>
                </div>
                
                <!-- No results message -->
                <div v-if="filteredAreas.length === 0 && areaSearchQuery" class="p-3 text-center text-gray-500 text-sm">
                  🔍 Không tìm thấy khu vực nào phù hợp
                </div>
              </div>
            </div>
          </div>
          
          <!-- Selected Area Display -->
          <div v-if="areaFilter" class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <span class="text-blue-600 mr-2">📍</span>
                <span class="text-sm text-blue-800 font-medium">
                  <strong>Khu vực đã chọn:</strong> {{ areaFilter }}
                </span>
              </div>
              <button 
                @click="areaFilter = ''" 
                class="text-blue-600 hover:text-blue-800 text-xs font-medium bg-white px-2 py-1 rounded border border-blue-200 hover:bg-blue-100 transition-colors"
              >
                ✕ Bỏ chọn
              </button>
            </div>
          </div>
          
          <!-- Area count info -->
          <div class="mt-2 text-xs text-gray-500 text-center">
            📊 Hiển thị {{ filteredAreas.length }} / {{ areas.length }} khu vực Hà Nội
          </div>
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
import webSocketService from '../services/websocket'

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
const districts = ref([]) // Danh sách quận/huyện Hà Nội
const showFilterSheet = ref(false)
const websocketStatus = ref('disconnected')
const areaSearchQuery = ref('') // Tìm kiếm trong danh sách khu vực
const shipperWorkAreas = ref([]) // Khu vực làm việc của shipper
const showAllDistricts = ref(false) // Hiển thị tất cả quận/huyện
const showAreaDropdown = ref(false) // Hiển thị dropdown khu vực
const showAllAreas = ref(false) // Hiển thị tất cả phường/xã (thêm vào đây)


const currentPage = ref(1)
const itemsPerPage = ref(10)

// Computed
const user = computed(() => authStore.user)
const stats = computed(() => orderStore.stats)
const orders = computed(() => orderStore.orders)
const notifications = computed(() => notificationStore.notifications)

const filteredOrders = computed(() => {
  let filtered = orders.value

  // Chỉ hiển thị đơn hàng đã được phân cho shipper
  filtered = filtered.filter(order => order.shipper_id)

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(order => 
      order.order_code?.toLowerCase().includes(query) ||
      order.shipping_name?.toLowerCase().includes(query) ||
      order.user?.full_name?.toLowerCase().includes(query) ||
      order.shipping_phone?.toLowerCase().includes(query) ||
      order.user?.phone_number?.toLowerCase().includes(query) ||
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

  // Filter by area (quận/huyện hoặc phường/xã)
  if (areaFilter.value) {
    const areaQuery = areaFilter.value.toLowerCase()
    filtered = filtered.filter(order => {
      const address = order.shipping_address?.toLowerCase() || ''
      
      // Kiểm tra xem địa chỉ có chứa quận/huyện hoặc phường/xã được chọn không
      return address.includes(areaQuery)
    })
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

// Computed areas for filtering (with smart search)
const filteredAreas = computed(() => {
  if (!areaSearchQuery.value) return areas.value
  
  const query = areaSearchQuery.value.toLowerCase().trim()
  
  // Tìm kiếm thông minh: ưu tiên kết quả bắt đầu bằng từ khóa
  return areas.value
    .filter(area => area.toLowerCase().includes(query))
    .sort((a, b) => {
      const aLower = a.toLowerCase()
      const bLower = b.toLowerCase()
      
      // Ưu tiên kết quả bắt đầu bằng từ khóa
      const aStartsWith = aLower.startsWith(query)
      const bStartsWith = bLower.startsWith(query)
      
      if (aStartsWith && !bStartsWith) return -1
      if (!aStartsWith && bStartsWith) return 1
      
      // Sau đó sắp xếp theo độ dài (ngắn hơn trước)
      if (a.length !== b.length) return a.length - b.length
      
      // Cuối cùng sắp xếp theo alphabet
      return a.localeCompare(b, 'vi')
    })
})

// Computed properties
const hasActiveFilters = computed(() => {
  return statusFilter.value || 
         (dateFilter.value && dateFilter.value !== 'today') || 
         areaFilter.value || 
         searchQuery.value
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
    'failed': 'Giao thất bại',
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
  { value: 'failed', label: 'Giao thất bại', activeClass: 'bg-orange-100 text-orange-800', dotClass: 'bg-orange-500' }
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

const getDateFilterText = () => {
  switch (dateFilter.value) {
    case 'yesterday':
      return 'Hôm qua'
    case 'last7':
      return '7 ngày gần nhất'
    case 'range':
      if (customDateRange.value.start && customDateRange.value.end) {
        return `${customDateRange.value.start} → ${customDateRange.value.end}`
      }
      return 'Khoảng ngày'
    default:
      return ''
  }
}

// WebSocket handlers
const handleWebSocketEvent = (eventType, data) => {
    console.log(`WebSocket event received: ${eventType}`, data)
    console.log('Event data structure:', JSON.stringify(data, null, 2))
    
    switch (eventType) {
        case 'status_updated':
            console.log('Handling status update:', data)
            handleOrderStatusUpdate(data)
            break
        case 'new_order':
            console.log('Handling new order:', data)
            handleNewOrder(data)
            break
        case 'location_updated':
            console.log('Handling location update:', data)
            handleLocationUpdate(data)
            break
        default:
            console.log('Unknown event type:', eventType, data)
    }
}

const handleOrderStatusUpdate = (data) => {
    console.log('Updating order status in store:', data)
    
    // Validate data before processing
    if (!data || !data.order_id) {
        console.error('Invalid status update data:', data)
        return
    }
    
    // Create order object from WebSocket data if needed
    let orderData = data.order
    if (!orderData && data.order_id) {
        orderData = {
            id: data.order_id,
            order_status: data.new_status || data.order_status
        }
    }
    
    // Update order in store
    if (orderData) {
        orderStore.updateOrder(orderData)
    }
    
    // Show notification (with safe access)
    const orderCode = data.order_code || data.order?.order_code || 'N/A'
    const newStatus = data.new_status || data.order?.order_status || data.order_status || 'N/A'
    showNotification(`Đơn hàng #${orderCode} đã cập nhật trạng thái: ${getStatusText(newStatus)}`)
    
    // Refresh stats if needed
    if (['delivered', 'failed', 'cancelled'].includes(newStatus)) {
            orderStore.fetchOrders()
    }
    
    // Force refresh orders list to show real-time updates
    orderStore.fetchOrders()
}

const handleNewOrder = (data) => {
    // Validate data before processing
    if (!data || !data.order_id) {
        console.error('Invalid new order data:', data)
        return
    }
    
    // Create order object from WebSocket data
    const orderData = {
        id: data.order_id,
        order_code: data.order_code,
        order_status: data.order_status,
        total_amount: data.total_amount,
        shipping_address: data.shipping_address,
        shipping_phone: data.shipping_phone,
        created_at: data.created_at,
        user: data.user
    }
    
    // Add new order to store
    orderStore.addOrder(orderData)
    
    // Show notification (with safe access)
    const orderCode = data.order_code || 'N/A'
    const userName = data.user?.name || 'Khách hàng'
    showNotification(`Đơn hàng mới #${orderCode} từ ${userName}`)
    
    // Refresh stats
        orderStore.fetchOrders()
}

const handleLocationUpdate = (data) => {
    // Validate data before processing
    if (!data || !data.order_id) {
        console.error('Invalid location update data:', data)
        return
    }
    
    // Update order location in store
    orderStore.updateOrderLocation(data.order_id, {
        latitude: data.latitude || data.lat,
        longitude: data.longitude || data.lng,
        address: data.address || data.shipping_address
    })
}

const showNotification = (message) => {
    // Create a simple notification
    const notification = {
        id: Date.now(),
        message,
        created_at: new Date().toISOString(),
        type: 'info'
    }
    
    notificationStore.addNotification(notification)
}

// Enhanced polling with hybrid logic
const startEnhancedPolling = () => {
    // Override WebSocket service polling method
    webSocketService.performPolling = async () => {
        try {
            // Fetch orders and stats
            await orderStore.fetchOrders()
            
            return true
        } catch (error) {
            console.error('Enhanced polling failed:', error)
            throw error
        }
    }
}

// Load areas from JSON file (Hà Nội only) - Đúng cấu trúc thực tế
const loadAreasFromJSON = async () => {
  try {
    const res = await fetch('/data/hanoi-districts.json')
    if (res.ok) {
      const data = await res.json()
      
      // Sử dụng Set để tránh trùng lặp
      const uniqueAreas = new Set()
      
      // Chỉ lấy dữ liệu Hà Nội (object đầu tiên)
      const hanoiData = data[0]
      
      if (hanoiData && hanoiData.phuongxa && Array.isArray(hanoiData.phuongxa)) {
        // Chỉ lấy các phường/xã có mã số bắt đầu bằng "101" (Hà Nội)
        hanoiData.phuongxa.forEach(ward => {
          const wardCode = ward.maphuongxa.toString()
          const wardName = ward.tenphuongxa
          
          // Chỉ thêm phường/xã của Hà Nội (mã 101xxxxx)
          if (wardCode.startsWith('101') && wardName && wardName.trim()) {
            uniqueAreas.add(wardName)
          }
        })
        
        // Chuyển Set thành Array và sắp xếp theo alphabet
        areas.value = Array.from(uniqueAreas).sort((a, b) => 
          a.localeCompare(b, 'vi')
        )
        
        // Không còn quận/huyện riêng, chỉ có phường/xã
        districts.value = []
        
        console.log(`Loaded ${areas.value.length} phường/xã từ file JSON Hà Nội`)
      }
    }
  } catch (error) {
    console.error('Error loading areas from JSON:', error)
    // Fallback: sử dụng danh sách phường/xã cơ bản của Hà Nội
    const fallbackAreas = [
      'Phường Hoàn Kiếm', 'Phường Cửa Nam', 'Phường Ba Đình', 'Phường Ngọc Hà',
      'Phường Giảng Võ', 'Phường Hai Bà Trưng', 'Phường Vĩnh Tuy', 'Phường Bạch Mai',
      'Phường Đống Đa', 'Phường Kim Liên', 'Phường Văn Miếu - Quốc Tử Giám',
      'Phường Láng', 'Phường Ô Chợ Dừa', 'Phường Hồng Hà', 'Phường Lĩnh Nam'
    ]
    
    areas.value = fallbackAreas
    districts.value = []
  }
}

// Simple click outside handler
const handleClickOutside = (event) => {
  const areaFilterElement = event.target.closest('.area-filter-container')
  if (!areaFilterElement) {
    // Close area dropdown
    showAreaDropdown.value = false
  }
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
        
        // Initialize WebSocket
        if (authStore.token) {
            webSocketService.init(authStore.token)
            websocketStatus.value = 'connecting'
            
            // Listen to shipper orders channel
            webSocketService.listenToShipperOrders(handleWebSocketEvent)
            
            // Update status when connected
            webSocketService.echo.connector.pusher.connection.bind('connected', () => {
                websocketStatus.value = 'connected'
                console.log('WebSocket connected successfully')
                
                // Refresh orders after connection to ensure real-time data
                orderStore.fetchOrders()
            })
            
            webSocketService.echo.connector.pusher.connection.bind('disconnected', () => {
                websocketStatus.value = 'disconnected'
                console.log('WebSocket disconnected')
            })
            
            webSocketService.echo.connector.pusher.connection.bind('error', (error) => {
                // Bỏ qua format error
                if (error.type === 'PusherError' && error.data?.code === 4200) {
                    return
                }
                websocketStatus.value = 'error'
                console.error('WebSocket connection error:', error)
                
                // Auto reconnect after error
                setTimeout(() => {
                    if (websocketStatus.value === 'error') {
                        websocketStatus.value = 'connecting'
                        webSocketService.init(authStore.token)
                    }
                }, 5000)
            })
        }
        
        // Start enhanced hybrid polling
        startEnhancedPolling()
        
        // Load areas from JSON file
        await loadAreasFromJSON()
        
        // Add click outside listener
        document.addEventListener('click', handleClickOutside)
        
    } catch (error) {
        console.error('Dashboard initialization error:', error)
    } finally {
        loading.value = false
    }
})

onUnmounted(() => {
    // Cleanup WebSocket
    webSocketService.disconnect()
    
    // Remove click outside listener
    document.removeEventListener('click', handleClickOutside)
})
</script> 