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
          <h1 class="text-lg font-semibold text-gray-900">Chi tiết đơn hàng</h1>
        </div>
        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-500">#{{ order?.order_code }}</span>
        </div>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="flex items-center justify-center py-12">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
    </div>

    <!-- Order Details -->
    <div v-else-if="order" class="p-4 space-y-6">
      <!-- Order Status -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-gray-900">Trạng thái đơn hàng</h2>
          <span :class="getStatusBadgeClass(order.order_status)" class="px-3 py-1 rounded-full text-sm font-medium">
            {{ getStatusText(order.order_status) }}
          </span>
        </div>
        
        <div class="space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Ngày đặt:</span>
            <span class="font-medium">{{ formatDate(order.created_at) }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Tổng tiền:</span>
            <span class="font-semibold text-lg text-green-600">{{ formatCurrency(order.total_amount) }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Phương thức thanh toán:</span>
            <span class="font-medium">{{ getPaymentMethodDisplay() }}</span>
          </div>
        </div>
      </div>

      <!-- Customer Info -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin khách hàng</h3>
        
       
        
        <div class="space-y-4">
          <!-- Người đặt hàng -->
          <div class="border-l-4 border-blue-500 pl-4">
            <h4 class="font-medium text-gray-900 mb-2">👤 Người đặt hàng</h4>
            <div class="space-y-1 text-sm text-gray-600">
              <div><strong>Họ tên:</strong> {{ getCustomerName() }}</div>
              <div><strong>Email:</strong> {{ getCustomerEmail() }}</div>
              <div><strong>SĐT:</strong> {{ getCustomerPhone() }}</div>
              <div v-if="getBuyerAddress()"><strong>Địa chỉ đặt hàng:</strong> {{ getBuyerAddress() }}</div>
            </div>
          </div>

          <!-- Thông tin giao hàng -->
          <div class="border-l-4 border-green-500 pl-4">
            <h4 class="font-medium text-gray-900 mb-2">🚚 Địa chỉ giao hàng</h4>
            <div class="space-y-1 text-sm text-gray-600">
              <div><strong>Người nhận:</strong> {{ getShippingName() }}</div>
              <div><strong>SĐT nhận hàng:</strong> {{ getShippingPhone() }}</div>
              <div v-if="getShippingEmail()"><strong>Email nhận hàng:</strong> {{ getShippingEmail() }}</div>
              <div><strong>Địa chỉ giao hàng:</strong> {{ getShippingAddress() }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Items -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Sản phẩm</h3>
        <div class="space-y-4">
          <div v-for="item in order.items" :key="item.id" class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
              <img v-if="item.product && item.product.images && item.product.images.length > 0" 
                   :src="getImageUrl(item.product.images[0].image_url)" 
                   :alt="item.product.name"
                   class="w-full h-full object-cover">
              <svg v-else class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
            <div class="flex-1">
              <h4 class="font-medium text-gray-900">{{ item.product?.name }}</h4>
              <p class="text-sm text-gray-500">{{ item.product?.description }}</p>
              <!-- Variant attributes -->
              <div v-if="item.variant_attributes" class="text-xs text-gray-400 mt-1">
                <span v-for="(value, key) in parseVariantAttributes(item.variant_attributes)" :key="key">
                  {{ key }}: {{ value }}
                  <span v-if="Object.keys(parseVariantAttributes(item.variant_attributes)).indexOf(key) !== Object.keys(parseVariantAttributes(item.variant_attributes)).length - 1">, </span>
                </span>
              </div>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-500">x{{ item.quantity }}</p>
              <p class="text-sm font-semibold text-green-600">{{ formatCurrency(item.subtotal) }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin đơn hàng</h3>
        <div class="space-y-3">
          <!-- Tổng tiền sản phẩm -->
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Tổng tiền sản phẩm:</span>
            <span class="font-medium">{{ formatCurrency(calculateProductTotal()) }}</span>
          </div>
          
          <!-- Phí vận chuyển -->
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Phí vận chuyển:</span>
            <span class="font-medium">{{ formatCurrency(order.shipping_fee || 0) }}</span>
          </div>
          
          <!-- Mã giảm giá -->
          <div v-if="order.discount_code" class="flex items-center justify-between">
            <span class="text-gray-600">Mã giảm giá:</span>
            <span class="font-medium">{{ order.discount_code }}</span>
          </div>
          
          <!-- Giảm giá -->
          <div v-if="order.discount_amount" class="flex items-center justify-between">
            <span class="text-gray-600">Giảm giá:</span>
            <span class="font-medium text-red-600">-{{ formatCurrency(order.discount_amount) }}</span>
          </div>
          
          <!-- Tổng cộng -->
          <div class="flex items-center justify-between border-t pt-3">
            <span class="text-lg font-semibold text-gray-900">Tổng cộng:</span>
            <span class="text-lg font-semibold text-green-600">{{ formatCurrency(order.total_amount) }}</span>
          </div>
        </div>
      </div>

      <!-- Status Updates -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lịch sử cập nhật</h3>
        <div v-if="order.status_histories && order.status_histories.length > 0" class="space-y-4">
          <div v-for="(update, index) in order.status_histories" :key="index" class="flex items-start space-x-3">
            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
            <div class="flex-1">
              <p class="font-medium text-gray-900">{{ getStatusText(update.status) }}</p>
              <p class="text-sm text-gray-500">{{ formatDateTime(update.created_at) }}</p>
              <p v-if="update.admin_note" class="text-sm text-gray-600 mt-1">{{ update.admin_note }}</p>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-4">
          <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-sm text-gray-500 mt-2">Chưa có lịch sử cập nhật</p>
        </div>
      </div>

      <!-- Shipper Location Info -->
      <div v-if="order.order_status === 'shipped'" class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vị trí shipper</h3>
        <div v-if="order.delivery_lat && order.delivery_lng" class="space-y-3">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900">Shipper đang giao hàng</p>
              <p class="text-xs text-gray-500">Cập nhật lúc: {{ formatDateTime(order.updated_at) }}</p>
            </div>
          </div>
          
          <div class="bg-gray-50 rounded-lg p-3">
            <div class="grid grid-cols-2 gap-4 text-sm">
              <div>
                <span class="text-gray-600">Vĩ độ:</span>
                <span class="font-medium ml-1">{{ order.delivery_lat }}</span>
              </div>
              <div>
                <span class="text-gray-600">Kinh độ:</span>
                <span class="font-medium ml-1">{{ order.delivery_lng }}</span>
              </div>
            </div>
            
            <div class="mt-3">
              <a 
                :href="`https://www.google.com/maps?q=${order.delivery_lat},${order.delivery_lng}`" 
                target="_blank"
                class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 text-sm"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Xem vị trí shipper trên Google Maps</span>
              </a>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-4">
          <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
          </svg>
          <p class="text-sm text-gray-500 mt-2">Chưa có vị trí shipper</p>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="bg-white rounded-lg shadow-sm border p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thao tác</h3>
        <div class="grid grid-cols-2 gap-3">
          <!-- Khi có 2 nút cùng xuất hiện, sắp xếp 2 cột -->
          <template v-if="order.order_status === 'shipped'">
            <button 
              @click="showCompleteModal = true"
              :disabled="actionLoading"
              class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 disabled:opacity-50"
            >
              Hoàn thành giao hàng
            </button>
            <button 
              @click="showFailedModal = true"
              :disabled="actionLoading"
              class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 disabled:opacity-50"
            >
              Giao hàng thất bại
            </button>
          </template>

          <!-- Các nút đứng một mình sẽ căn giữa -->
          <button 
            v-if="order.order_status === 'pending'"
            @click="acceptOrder"
            :disabled="actionLoading"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 disabled:opacity-50 col-span-2 w-full"
          >
            Nhận đơn hàng
          </button>

          <!-- Trước khi shipper bấm Nhận: hiển thị Nhận/Từ chối -->
          <template v-if="order.order_status === 'processing' && !hasAccepted">
            <button 
              @click="acceptOrder"
              :disabled="actionLoading"
              class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 disabled:opacity-50"
            >
              Nhận đơn hàng
            </button>
            <button 
              @click="openRejectModal"
              :disabled="actionLoading"
              class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 disabled:opacity-50"
            >
              Từ chối
            </button>
          </template>

          <!-- Sau khi shipper bấm Nhận: hiển thị Bắt đầu giao hàng -->
          <button 
            v-if="order.order_status === 'processing' && hasAccepted"
            @click="showStartDeliveryModal = true"
            :disabled="actionLoading"
            class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 disabled:opacity-50 col-span-2 w-full"
          >
            Bắt đầu giao hàng
          </button>

          <!-- Nút xác nhận hoàn về kho - chỉ hiển thị khi shipper giao hàng thất bại (admin hủy đã tự hoàn vào kho) -->
          <button 
            v-if="order.order_status === 'failed'"
            @click="showReturnToWarehouseModal = true"
            :disabled="actionLoading"
            class="bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 disabled:opacity-50 col-span-2 w-full"
          >
            Xác nhận đã hoàn về kho
          </button>

        </div>
      </div>
    </div>

    <!-- Reject Reason Modal -->
    <div v-if="showRejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lý do từ chối đơn hàng</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Vui lòng nhập lý do <span class="text-red-600">*</span></label>
            <textarea 
              v-model="rejectionReason"
              rows="3"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Nhập lý do từ chối..."
              required
            ></textarea>
            <p v-if="rejectError" class="mt-1 text-red-600 text-xs">{{ rejectError }}</p>
          </div>
          <div class="flex space-x-3">
            <button 
              @click="closeRejectModal"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              @click="confirmReject"
              :disabled="actionLoading || !rejectionReason.trim()"
              class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 disabled:opacity-50"
            >
              Xác nhận từ chối
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Start Delivery Modal -->
    <div v-if="showStartDeliveryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bắt đầu giao hàng</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ghi chú (tùy chọn)</label>
            <textarea 
              v-model="startDeliveryNotes"
              rows="3"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Nhập ghi chú nếu cần..."
            ></textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh hiện trạng <span class="text-red-600">*</span></label>
            <input 
              ref="startDeliveryImageInput"
              type="file" 
              @change="handleStartDeliveryImageUpload"
              accept="image/*"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
            <div v-if="!startDeliveryImage && !startDeliveryImagePreview" class="mt-1 text-red-600 text-xs">
              Vui lòng tải lên ảnh hiện trạng đơn hàng trước khi giao
            </div>
            <div v-if="startDeliveryImagePreview" class="mt-2">
              <img :src="startDeliveryImagePreview" alt="Preview" class="w-20 h-20 object-cover rounded-lg">
              <button @click="removeStartDeliveryImage" class="mt-1 text-red-600 text-sm">Xóa ảnh</button>
            </div>
          </div>
          <div class="flex space-x-3">
            <button 
              @click="showStartDeliveryModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              @click="startDelivery"
              :disabled="actionLoading || !startDeliveryImage"
              class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 disabled:opacity-50"
            >
              Bắt đầu giao
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Complete Delivery Modal -->
    <div v-if="showCompleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Hoàn thành giao hàng</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ghi chú (tùy chọn)</label>
            <textarea 
              v-model="completeNotes"
              rows="3"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Nhập ghi chú nếu cần..."
            ></textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh chứng minh <span class="text-red-600">*</span></label>
            <input 
              ref="completeImageInput"
              type="file" 
              @change="handleCompleteImageUpload"
              accept="image/*"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
            <div v-if="!completeImage && !completeImagePreview" class="mt-1 text-red-600 text-xs">
              Vui lòng tải lên ảnh chứng minh việc giao hàng thành công
            </div>
            <div v-if="completeImagePreview" class="mt-2">
              <img :src="completeImagePreview" alt="Preview" class="w-20 h-20 object-cover rounded-lg">
              <button @click="removeCompleteImage" class="mt-1 text-red-600 text-sm">Xóa ảnh</button>
            </div>
          </div>
          <div class="flex space-x-3">
            <button 
              @click="showCompleteModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              @click="completeDelivery"
              :disabled="actionLoading || !completeImage"
              class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 disabled:opacity-50"
            >
              Hoàn thành
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Failed Delivery Modal -->
    <div v-if="showFailedModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Giao hàng thất bại</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Lý do thất bại</label>
            <textarea 
              v-model="failedReason"
              rows="3"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Nhập lý do giao hàng thất bại..."
              required
            ></textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh chứng minh <span class="text-red-600">*</span></label>
            <input 
              ref="failedImageInput"
              type="file" 
              @change="handleFailedImageUpload"
              accept="image/*"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
            <div v-if="!failedImage && !failedImagePreview" class="mt-1 text-red-600 text-xs">
              Vui lòng tải lên ảnh chứng minh việc giao hàng thất bại
            </div>
            <div v-if="failedImagePreview" class="mt-2">
              <img :src="failedImagePreview" alt="Preview" class="w-20 h-20 object-cover rounded-lg">
              <button @click="removeFailedImage" class="mt-1 text-red-600 text-sm">Xóa ảnh</button>
            </div>
          </div>
          <div class="flex space-x-3">
            <button 
              @click="showFailedModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
            >
              Hủy
            </button>
            <button 
              @click="failedDelivery"
              :disabled="actionLoading || !failedReason.trim() || !failedImage"
              class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 disabled:opacity-50"
            >
              Xác nhận thất bại
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Return to Warehouse Modal -->
    <div v-if="showReturnToWarehouseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Xác nhận hoàn hàng về kho (Giao thất bại)</h3>
        
        <div class="mb-4">
          <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 mb-4">
            <div class="flex items-center">
              <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
              </svg>
              <span class="text-sm font-medium text-orange-800">Thông báo quan trọng</span>
            </div>
            <p class="text-sm text-orange-700 mt-1">
              Đơn hàng này đã được giao thất bại. Khi xác nhận hoàn về kho, tất cả sản phẩm sẽ được cộng lại vào kho và đơn hàng sẽ được đánh dấu là "Đã hoàn về kho".
            </p>
          </div>
          
          <div class="text-sm text-gray-600 mb-4">
            <p><strong>Đơn hàng:</strong> #{{ order?.order_code }}</p>
            <p><strong>Số sản phẩm:</strong> {{ order?.items?.length || 0 }} loại</p>
            <p><strong>Tổng số lượng:</strong> {{ getTotalQuantity() }} sản phẩm</p>
          </div>
        </div>
        
        <div class="flex justify-end space-x-3">
          <button 
            @click="showReturnToWarehouseModal = false"
            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
          >
            Hủy
          </button>
          <button 
            @click="returnToWarehouse"
            :disabled="actionLoading"
            class="bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 disabled:opacity-50"
          >
            {{ actionLoading ? 'Đang xử lý...' : 'Xác nhận hoàn về kho' }}
          </button>
        </div>
      </div>
    </div>


  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useOrderStore } from '../stores/orders'

const route = useRoute()
const router = useRouter()
const orderStore = useOrderStore()

const loading = ref(false)
const actionLoading = ref(false)
const showRejectModal = ref(false)
const rejectionReason = ref('')
const rejectError = ref('')
const showCompleteModal = ref(false)
const showFailedModal = ref(false)
const showStartDeliveryModal = ref(false)
const showReturnToWarehouseModal = ref(false) // Modal for returning failed delivery to warehouse (admin cancelled orders auto-return to warehouse)
const completeNotes = ref('')
const failedReason = ref('')
const startDeliveryNotes = ref('')
const completeImage = ref(null)
const failedImage = ref(null)
const startDeliveryImage = ref(null)
const completeImagePreview = ref('')
const failedImagePreview = ref('')
const startDeliveryImagePreview = ref('')
// Thêm refs cho các input file
const completeImageInput = ref(null)
const failedImageInput = ref(null)
const startDeliveryImageInput = ref(null)

const order = computed(() => orderStore.currentOrder)

// Cờ cục bộ: chỉ chuyển sang "Bắt đầu giao hàng" sau khi shipper bấm Nhận trong phiên này
const acceptedLocal = ref(false)
const hasAccepted = computed(() => acceptedLocal.value)

// Balanced 3s polling for realtime updates
const POLL_INTERVAL_MS = 3000
let pollTimer = null
let pollInFlight = false

function isFinalStatus(status) {
  return ['delivered', 'cancelled', 'failed'].includes(status)
}

function startPolling() {
  if (pollTimer) return
  
  // Chạy polling ngay lập tức và sau đó lặp lại mỗi 1 giây
  pollTimer = setInterval(async () => {
    if (pollInFlight) return
    pollInFlight = true
    try {
      if (route.params.id) {
        const data = await orderStore.fetchOrder(route.params.id)
        if (!data) {
          clearInterval(pollTimer)
          pollTimer = null
          router.push({ name: 'Dashboard' })
          return
        }
        // Dừng polling nếu đơn hàng đã hoàn thành
        if (order.value && isFinalStatus(order.value.order_status)) {
          clearInterval(pollTimer)
          pollTimer = null
        }
      }
    } catch (e) {
      console.error('Polling error:', e)
      // Tiếp tục polling ngay cả khi có lỗi để đảm bảo cập nhật liên tục
    } finally {
      pollInFlight = false
    }
  }, POLL_INTERVAL_MS)
}

onMounted(async () => {
  if (route.params.id) {
    loading.value = true
    try {
      const data = await orderStore.fetchOrder(route.params.id)
      if (!data) {
        router.push({ name: 'Dashboard' })
        return
      }
      // Luôn bắt đầu ở trạng thái CHƯA nhận để hiển thị Nhận/Từ chối
      acceptedLocal.value = false
    } catch (error) {
      console.error('Error fetching order:', error)
    } finally {
      loading.value = false
    }
  }
  // Bắt đầu realtime updates mỗi 3 giây (chạy song song với WebSocket để đảm bảo cập nhật ngay cả khi WebSocket đang reconnect)
  startPolling()
})

onUnmounted(() => {
  if (pollTimer) {
    clearInterval(pollTimer)
    pollTimer = null
  }
})

// Hiển thị thuần tiếng Việt & ẨN hoàn toàn chữ "confirmed" (map sang Đang xử lý)
const getStatusText = (status) => {
  const statusMap = {
    'pending': 'Chờ xử lý',
    // Ẩn "confirmed" khỏi UI: coi như vẫn ở giai đoạn đang xử lý chung
    'confirmed': 'Đang xử lý',
    'processing': 'Đang xử lý',
    'shipped': 'Đang giao hàng',
    'delivered': 'Đã giao hàng',
    'cancelled': 'Đã hủy',
    'failed': 'Giao hàng thất bại'
  }
  return statusMap[status] || 'Không xác định'
}

const getStatusBadgeClass = (status) => {
  const classMap = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'confirmed': 'bg-blue-100 text-blue-800',
    'processing': 'bg-purple-100 text-purple-800',
    'shipped': 'bg-indigo-100 text-indigo-800',
    'delivered': 'bg-green-100 text-green-800',
    'cancelled': 'bg-red-100 text-red-800',
    'failed': 'bg-red-100 text-red-800' // Added 'failed' status
  }
  return classMap[status] || 'bg-gray-100 text-gray-800'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('vi-VN')
}

const formatDateTime = (date) => {
  return new Date(date).toLocaleString('vi-VN')
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
  }).format(amount)
}

const getImageUrl = (imageUrl) => {
  if (!imageUrl) return ''
  if (imageUrl.startsWith('http')) return imageUrl
  return `/storage/${imageUrl}`
}

const parseVariantAttributes = (attributes) => {
  if (!attributes) return {}
  if (typeof attributes === 'string') {
    try {
      return JSON.parse(attributes)
    } catch {
      return {}
    }
  }
  return attributes
}

const calculateProductTotal = () => {
  if (!order.value || !order.value.items) return 0
  return order.value.items.reduce((total, item) => {
    const itemTotal = parseFloat(item.subtotal) || 0
    return total + itemTotal
  }, 0)
}

const acceptOrder = async () => {
  actionLoading.value = true
  try {
    await orderStore.acceptOrder(order.value.id)
    await orderStore.fetchOrder(order.value.id)
    acceptedLocal.value = true
  } catch (error) {
    console.error('Error accepting order:', error)
  } finally {
    actionLoading.value = false
  }
}

function openRejectModal() {
  rejectError.value = ''
  rejectionReason.value = ''
  showRejectModal.value = true
}

function closeRejectModal() {
  showRejectModal.value = false
}

// Từ chối: gửi status 'confirmed' lên backend để UNASSIGN, nhưng UI sẽ hiển thị là 'Đang xử lý' (không bao giờ hiện chữ confirmed)
const confirmReject = async () => {
  if (!rejectionReason.value.trim()) {
    rejectError.value = 'Vui lòng nhập lý do từ chối.'
    return
  }
  actionLoading.value = true
  rejectError.value = ''
  try {
    await orderStore.updateOrderStatus(order.value.id, 'confirmed', rejectionReason.value.trim())
    showRejectModal.value = false
    router.push({ name: 'Dashboard' })
  } catch (error) {
    console.error('Error rejecting order:', error)
    rejectError.value = 'Có lỗi xảy ra. Vui lòng thử lại.'
  } finally {
    actionLoading.value = false
  }
}

const getCurrentPosition = () => {
  return new Promise((resolve, reject) => {
    if (!navigator.geolocation) {
      reject(new Error('Geolocation không được hỗ trợ'))
      return
    }
    navigator.geolocation.getCurrentPosition(resolve, reject, {
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 60000
    })
  })
}

const startDelivery = async () => {
  // Validate trước khi tiếp tục
  if (!startDeliveryImage.value) {
    alert('Vui lòng tải lên ảnh hiện trạng đơn hàng!');
    return;
  }
  
  actionLoading.value = true
  try {
    // Lấy vị trí hiện tại
    const position = await getCurrentPosition()
    const location = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    }
    
    // Kiểm tra image có phải là file hợp lệ không
    const imageToUpload = startDeliveryImage.value instanceof File ? startDeliveryImage.value : null;
    if (!imageToUpload) {
      throw new Error('Vui lòng tải lên ảnh hiện trạng đơn hàng!');
    }
    
    // Gọi API với location data và ảnh
    await orderStore.startDeliveryWithImage(order.value.id, startDeliveryNotes.value, imageToUpload, location)
    await orderStore.fetchOrder(order.value.id)
    showStartDeliveryModal.value = false
    startDeliveryNotes.value = ''
    startDeliveryImage.value = null
    startDeliveryImagePreview.value = null
  } catch (error) {
    console.error('Error starting delivery:', error)
    // Nếu không lấy được vị trí, vẫn cập nhật status với ảnh
    try {
      // Kiểm tra lại một lần nữa
      const imageToUpload = startDeliveryImage.value instanceof File ? startDeliveryImage.value : null;
      if (!imageToUpload) {
        throw new Error('Vui lòng tải lên ảnh hiện trạng đơn hàng!');
      }
      await orderStore.startDeliveryWithImage(order.value.id, startDeliveryNotes.value, imageToUpload)
      await orderStore.fetchOrder(order.value.id)
      showStartDeliveryModal.value = false
      startDeliveryNotes.value = ''
      startDeliveryImage.value = null
      startDeliveryImagePreview.value = null
    } catch (secondError) {
      console.error('Error updating status without location:', secondError)
    }
  } finally {
    actionLoading.value = false
  }
}

const completeDelivery = async () => {
  // Validate trước khi tiếp tục
  if (!completeImage.value) {
    alert('Vui lòng tải lên ảnh chứng minh giao hàng thành công!');
    return;
  }
  
  actionLoading.value = true
  try {
    // Kiểm tra image có phải là file hợp lệ không
    const imageToUpload = completeImage.value instanceof File ? completeImage.value : null;
    if (!imageToUpload) {
      throw new Error('Vui lòng tải lên ảnh chứng minh giao hàng thành công!');
    }
    
    await orderStore.updateOrderStatusWithImage(order.value.id, 'delivered', completeNotes.value, imageToUpload)
    await orderStore.fetchOrder(order.value.id)
    showCompleteModal.value = false
    completeNotes.value = ''
    completeImage.value = null
    completeImagePreview.value = null
  } catch (error) {
    console.error('Error completing delivery:', error)
    alert('Đã xảy ra lỗi khi hoàn thành giao hàng. Vui lòng thử lại.')
  } finally {
    actionLoading.value = false
  }
}

const failedDelivery = async () => {
  // Validate trước khi tiếp tục
  if (!failedReason.value.trim()) {
    alert('Vui lòng nhập lý do giao hàng thất bại!');
    return;
  }
  
  if (!failedImage.value) {
    alert('Vui lòng tải lên ảnh chứng minh giao hàng thất bại!');
    return;
  }
  
  actionLoading.value = true
  try {
    // Kiểm tra image có phải là file hợp lệ không
    const imageToUpload = failedImage.value instanceof File ? failedImage.value : null;
    if (!imageToUpload) {
      throw new Error('Vui lòng tải lên ảnh chứng minh giao hàng thất bại!');
    }
    
    // Khi shipper giao hàng thất bại, set trạng thái thành 'failed'
    // (khác với admin hủy đơn = 'cancelled' + tự động hoàn vào kho)
    await orderStore.updateOrderStatusWithImage(order.value.id, 'failed', failedReason.value, imageToUpload)
    await orderStore.fetchOrder(order.value.id)
    showFailedModal.value = false
    failedReason.value = ''
    failedImage.value = null
    failedImagePreview.value = null
  } catch (error) {
    console.error('Error marking delivery as failed:', error)
    alert('Đã xảy ra lỗi khi xác nhận giao hàng thất bại. Vui lòng thử lại.')
  } finally {
    actionLoading.value = false
  }
}

const returnToWarehouse = async () => {
  actionLoading.value = true
  try {
    // Chỉ cho phép hoàn về kho khi shipper giao hàng thất bại (admin hủy đã tự hoàn vào kho)
    await orderStore.returnToWarehouse(order.value.id, 'Đã hoàn trả hàng về kho do giao thất bại')
    await orderStore.fetchOrder(order.value.id)
    showReturnToWarehouseModal.value = false
  } catch (error) {
    console.error('Error returning to warehouse:', error)
  } finally {
    actionLoading.value = false
  }
}

// Image upload handlers
const handleCompleteImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    completeImage.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      completeImagePreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const removeCompleteImage = () => {
  completeImage.value = null
  completeImagePreview.value = null
  // Reset input file để có thể chọn lại cùng một file
  if (completeImageInput.value) {
    completeImageInput.value.value = ''
  }
}

const handleFailedImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    failedImage.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      failedImagePreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const removeFailedImage = () => {
  failedImage.value = null
  failedImagePreview.value = null
  // Reset input file để có thể chọn lại cùng một file
  if (failedImageInput.value) {
    failedImageInput.value.value = ''
  }
}

const handleStartDeliveryImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    startDeliveryImage.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      startDeliveryImagePreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const removeStartDeliveryImage = () => {
  startDeliveryImage.value = null
  startDeliveryImagePreview.value = null
  // Reset input file để có thể chọn lại cùng một file
  if (startDeliveryImageInput.value) {
    startDeliveryImageInput.value.value = ''
  }
}

const getPaymentMethodDisplay = () => {
  // Kiểm tra cả paymentMethod và payment_method
  if (order.value?.paymentMethod?.name) {
    return order.value.paymentMethod.name
  }
  
  // Nếu có payment_method object (có thể do API trả về dưới dạng snake_case)
  if (order.value?.payment_method && typeof order.value.payment_method === 'object' && order.value.payment_method.name) {
    return order.value.payment_method.name
  }
  
  // Nếu payment_method là string
  if (order.value?.payment_method && typeof order.value.payment_method === 'string') {
    return order.value.payment_method
  }
  
  return 'Tiền mặt'
}

// Customer information methods with comprehensive fallback logic
const getCustomerName = () => {
  return order.value?.buyer_name || 
         order.value?.customer_name || 
         order.value?.user?.name || 
         'Không có thông tin'
}

const getCustomerEmail = () => {
  return order.value?.buyer_email || 
         order.value?.customer_email || 
         order.value?.user?.email || 
         'Không có thông tin'
}

const getCustomerPhone = () => {
  return order.value?.buyer_phone || 
         order.value?.customer_phone || 
         order.value?.user?.phone || 
         'Không có thông tin'
}

const getBuyerAddress = () => {
  return order.value?.buyer_address || ''
}

const getShippingName = () => {
  return order.value?.shipping_name || 
         order.value?.buyer_name || 
         order.value?.customer_name || 
         order.value?.user?.name || 
         'Không có thông tin'
}

const getShippingEmail = () => {
  return order.value?.shipping_email || 
         order.value?.buyer_email || 
         order.value?.customer_email || 
         order.value?.user?.email || ''
}

const getShippingPhone = () => {
  return order.value?.shipping_phone || 
         order.value?.buyer_phone || 
         order.value?.customer_phone || 
         order.value?.user?.phone || 
         'Không có thông tin'
}

const getShippingAddress = () => {
  return order.value?.shipping_address || 
         order.value?.buyer_address || 
         'Không có thông tin'
}

const getTotalQuantity = () => {
  if (!order.value || !order.value.items) return 0;
  return order.value.items.reduce((sum, item) => sum + (parseInt(item.quantity) || 0), 0);
}

// Image upload handlers
</script> 