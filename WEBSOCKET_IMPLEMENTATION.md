# WebSocket Implementation for Real-time Order Tracking

## Tổng quan

Hệ thống WebSocket được implement để cung cấp real-time updates cho 3 bên:
- **Admin**: Tracking đơn hàng real-time
- **Client**: Timeline vận chuyển đơn hàng real-time  
- **Shipper**: Danh sách và cập nhật đơn hàng real-time

## Cấu trúc hệ thống

### 1. Events (Backend)

#### OrderStatusUpdated
- **Mục đích**: Broadcast khi trạng thái đơn hàng thay đổi
- **Channels**: 
  - `admin.orders` (private)
  - `client.orders.{userId}` (private)
  - `shipper.orders` (private)
  - `orders.{orderId}` (public)
- **Queue**: Implement ShouldQueue với retry logic
- **Logging**: Tự động log khi event được dispatch

#### OrderLocationUpdated
- **Mục đích**: Broadcast khi vị trí đơn hàng thay đổi
- **Channels**: Tương tự OrderStatusUpdated
- **Queue**: Implement ShouldQueue với timeout ngắn hơn
- **Rate Limiting**: Giới hạn 10 updates/phút cho shipper

#### NewOrderCreated
- **Mục đích**: Broadcast khi có đơn hàng mới
- **Channels**: 
  - `admin.orders` (private)
  - `shipper.orders` (private)
  - `orders.new` (public)
- **Auto-dispatch**: Tự động qua model observer

### 2. Broadcasting Channels (Backend)

#### Private Channels
- `admin.orders`: Chỉ admin mới có thể truy cập
- `client.orders.{userId}`: Chỉ client với userId tương ứng mới có thể truy cập
- `shipper.orders`: Chỉ shipper mới có thể truy cập

#### Public Channels
- `orders.{orderId}`: Tất cả user đã đăng nhập có thể truy cập
- `orders.{orderId}.location`: Tất cả user đã đăng nhập có thể truy cập
- `orders.new`: Tất cả user đã đăng nhập có thể truy cập

### 3. Frontend Services

#### Shipper WebSocket Service
- **File**: `resources/js/shipper-app/services/websocket.js`
- **Chức năng**: 
  - Kết nối WebSocket với authentication
  - Listen to shipper orders channel
  - Advanced reconnection logic với exponential backoff
  - Heartbeat monitoring và connection health check
  - Auto-reconnection với configurable attempts

#### Admin WebSocket Service
- **File**: `resources/js/admin/services/websocket.js`
- **Chức năng**: 
  - Kết nối WebSocket với authentication
  - Listen to admin orders channel
  - Advanced reconnection logic
  - Connection monitoring và health check

#### Client WebSocket Service
- **File**: `resources/js/client/services/websocket.js`
- **Chức năng**: 
  - Kết nối WebSocket với authentication
  - Listen to client orders channel
  - Advanced reconnection logic
  - Connection monitoring

### 4. Authentication & Security

#### BroadcastServiceProvider
- **File**: `app/Providers/BroadcastServiceProvider.php`
- **Chức năng**:
  - Channel authorization callbacks
  - Role-based access control
  - Custom authentication logic
  - Middleware integration

#### Rate Limiting
- **Location Updates**: 10 updates/phút cho shipper
- **Status Updates**: Không giới hạn (admin/shipper)
- **New Orders**: Không giới hạn

### 5. Queue & Performance

#### Event Queueing
- **OrderStatusUpdated**: 3 retries, 30s timeout
- **OrderLocationUpdated**: 2 retries, 20s timeout
- **NewOrderCreated**: Không queue (immediate broadcast)

#### Performance Monitoring
- Memory usage tracking
- Execution time monitoring
- Database query logging
- Slow query detection

### 6. Frontend Components

#### WebSocket Status Components
- **Admin**: `resources/js/admin/components/WebSocketStatus.vue`
- **Client**: `resources/js/client/components/WebSocketStatus.vue`
- **Shipper**: Integrated vào Dashboard.vue

#### WebSocket Monitor (Admin)
- **File**: `resources/js/admin/components/WebSocketMonitor.vue`
- **Chức năng**:
  - Real-time connection status
  - Event statistics
  - Connection logs
  - Channel status monitoring

## Cài đặt và cấu hình

### 1. Backend Dependencies

```bash
composer require laravel/reverb pusher/pusher-php-server
```

### 2. Environment Variables

```env
# WebSocket Configuration
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your-pusher-app-id
PUSHER_APP_KEY=your-pusher-key
PUSHER_APP_SECRET=your-pusher-secret
PUSHER_APP_CLUSTER=mt1
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_ENCRYPTED=true

# Queue Configuration
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Logging Configuration
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### 3. Frontend Dependencies

```bash
npm install laravel-echo pusher-js
```

### 4. Service Provider Registration

```php
// config/app.php
'providers' => [
    // ...
    App\Providers\BroadcastServiceProvider::class,
]
```

## Sử dụng

### 1. Khởi tạo WebSocket trong Component

```javascript
import webSocketService from '../services/websocket'

// Trong onMounted
onMounted(() => {
  if (authStore.token) {
    webSocketService.init(authStore.token)
    
    // Listen to orders channel
    webSocketService.listenToShipperOrders(handleWebSocketEvent)
    
    // Listen to connection events
    window.addEventListener('websocket-connection', handleConnectionEvent)
  }
})

// Trong onUnmounted
onUnmounted(() => {
  webSocketService.disconnect()
  window.removeEventListener('websocket-connection', handleConnectionEvent)
})
```

### 2. Handle WebSocket Events

```javascript
const handleWebSocketEvent = (eventType, data) => {
  switch (eventType) {
    case 'status_updated':
      handleOrderStatusUpdate(data)
      break
    case 'new_order':
      handleNewOrder(data)
      break
    case 'location_updated':
      handleLocationUpdate(data)
      break
  }
}

const handleConnectionEvent = (event) => {
  const { type, data, timestamp, connectionDuration } = event.detail
  
  switch (type) {
    case 'connected':
      console.log('WebSocket connected')
      break
    case 'disconnected':
      console.log('WebSocket disconnected')
      break
    case 'error':
      console.error('WebSocket error:', data)
      break
  }
}
```

### 3. Dispatch Events từ Backend

```php
// Khi cập nhật trạng thái đơn hàng
event(new OrderStatusUpdated($order, $oldStatus, $newStatus, 'admin'));

// Khi cập nhật vị trí
event(new OrderLocationUpdated($order, $latitude, $longitude, $address, 'shipper'));

// Khi tạo đơn hàng mới (tự động qua model observer)
```

### 4. Rate Limiting

```php
// Trong controller
use Illuminate\Support\Facades\RateLimiter;

$key = 'location_update_' . $shipper->id;
if (RateLimiter::tooManyAttempts($key, 10)) {
    $seconds = RateLimiter::availableIn($key);
    return response()->json([
        'message' => "Quá nhiều cập nhật vị trí. Vui lòng thử lại sau {$seconds} giây.",
        'retry_after' => $seconds
    ], 429);
}

RateLimiter::hit($key, 60); // 1 phút
```

## Luồng hoạt động

### 1. Order Status Update Flow
1. Admin/Shipper cập nhật trạng thái đơn hàng
2. Controller dispatch `OrderStatusUpdated` event
3. Event được queue và xử lý bởi worker
4. Event được broadcast đến các channels tương ứng
5. Frontend nhận event và cập nhật UI real-time
6. Logging và monitoring được thực hiện

### 2. Location Update Flow
1. Shipper cập nhật vị trí giao hàng
2. Rate limiting được kiểm tra
3. Controller dispatch `OrderLocationUpdated` event
4. Event được queue và xử lý
5. Event được broadcast đến các channels
6. Frontend cập nhật bản đồ và timeline real-time

### 3. New Order Flow
1. Client tạo đơn hàng mới
2. Model observer tự động dispatch `NewOrderCreated` event
3. Event được broadcast ngay lập tức đến admin và shipper
4. Dashboard cập nhật real-time
5. Logging được thực hiện

## Bảo mật

### 1. Channel Authorization
- Private channels được bảo vệ bởi middleware
- Role-based access control
- CSRF token và Authorization header validation
- Custom authentication logic trong BroadcastServiceProvider

### 2. Rate Limiting
- Location updates: 10/phút cho shipper
- Status updates: Không giới hạn
- Configurable limits per user type

### 3. Data Validation
- Tất cả data được validate trước khi broadcast
- Không có sensitive information trong events
- Input sanitization và validation

## Monitoring và Debugging

### 1. WebSocket Monitor Dashboard
- Real-time connection status
- Event statistics và logs
- Channel health monitoring
- Performance metrics

### 2. Logging System
- Event dispatch logging
- Connection status logging
- Error logging với stack traces
- Performance monitoring

### 3. Database Monitoring
- Slow query detection (>100ms)
- Query execution logging
- Connection monitoring
- Performance metrics

### 4. Frontend Monitoring
- Connection health checks
- Heartbeat monitoring
- Reconnection attempts tracking
- Event delivery monitoring

## Troubleshooting

### 1. Connection Issues
- Kiểm tra Pusher credentials
- Kiểm tra network connectivity
- Kiểm tra CORS settings
- Kiểm tra authentication middleware

### 2. Event Not Received
- Kiểm tra channel authorization
- Kiểm tra event listeners
- Kiểm tra queue workers
- Kiểm tra console logs

### 3. Performance Issues
- Monitor memory usage
- Check queue processing time
- Monitor database performance
- Check WebSocket server resources

### 4. Rate Limiting Issues
- Kiểm tra rate limit configuration
- Monitor rate limit hits
- Adjust limits nếu cần thiết
- Check user permissions

## Deployment Checklist

### 1. Environment Setup
- [ ] Pusher credentials configured
- [ ] Queue connection configured (Redis recommended)
- [ ] Broadcasting enabled
- [ ] Logging configured

### 2. Service Providers
- [ ] BroadcastServiceProvider registered
- [ ] Queue workers configured
- [ ] Event listeners registered

### 3. Frontend Configuration
- [ ] Laravel Echo installed
- [ ] Pusher.js installed
- [ ] Environment variables set
- [ ] WebSocket services imported

### 4. Testing
- [ ] Connection establishment
- [ ] Event broadcasting
- [ ] Channel authorization
- [ ] Rate limiting
- [ ] Reconnection logic

### 5. Monitoring
- [ ] WebSocket monitor dashboard
- [ ] Log aggregation
- [ ] Performance monitoring
- [ ] Error tracking

## Tương lai

### 1. Planned Features
- Push notifications integration
- Offline event queuing
- Event replay functionality
- Advanced filtering và subscription management
- Multi-tenant support
- Load balancing

### 2. Scalability
- Redis clustering
- Horizontal scaling
- CDN integration
- Edge computing support
- Microservices architecture

### 3. Analytics
- Event delivery analytics
- User engagement metrics
- Performance analytics
- Business intelligence integration
