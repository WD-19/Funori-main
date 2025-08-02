
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Redirecting to PayPal...</title>
</head>
<body>
    <form id="paypalForm" action="{{ route('paypal.process') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order_id }}">
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('paypalForm').submit();
        });
    </script>
</body>
</html>