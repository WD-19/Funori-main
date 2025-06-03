<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $paymentMethod = PaymentMethod::inRandomOrder()->first() ?? PaymentMethod::factory()->create();
        $shippingMethod = ShippingMethod::inRandomOrder()->first() ?? ShippingMethod::factory()->create();

        $subtotal = $this->faker->randomFloat(2, 100, 5000);
        $shippingFee = $shippingMethod->cost;
        $discountAmount = $this->faker->randomFloat(2, 0, $subtotal * 0.1); // Giảm giá tối đa 10% subtotal
        $taxAmount = $subtotal * 0.08; // Ví dụ 8% thuế
        $totalAmount = $subtotal + $shippingFee + $taxAmount - $discountAmount;

        $orderedAt = $this->faker->dateTimeBetween('-6 months', 'now');
        $deliveredAt = null;
        $cancelledAt = null;
        $cancellationReason = null;

        $orderStatus = $this->faker->randomElement(['pending_confirmation', 'processing', 'shipped', 'delivered', 'cancelled', 'returned']);

        if ($orderStatus == 'delivered') {
            $deliveredAt = $this->faker->dateTimeBetween($orderedAt, 'now');
        } elseif ($orderStatus == 'cancelled' || $orderStatus == 'returned') {
            $cancelledAt = $this->faker->dateTimeBetween($orderedAt, 'now');
            $cancellationReason = $this->faker->sentence();
        }

        return [
            'user_id' => $user->id,
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'customer_name' => $user->full_name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone_number,
            'shipping_address' => $this->faker->address(),
            'subtotal_amount' => $subtotal,
            'shipping_fee' => $shippingFee,
            'discount_amount' => $discountAmount,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'payment_method_id' => $paymentMethod->id,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'shipping_method_id' => $shippingMethod->id,
            'order_status' => $orderStatus,
            'customer_note' => $this->faker->boolean(30) ? $this->faker->sentence() : null,
            'admin_note' => $this->faker->boolean(10) ? $this->faker->sentence() : null,
            'ordered_at' => $orderedAt,
            'delivered_at' => $deliveredAt,
            'cancelled_at' => $cancelledAt,
            'cancellation_reason' => $cancellationReason,
            'created_at' => $orderedAt,
            'updated_at' => $this->faker->dateTimeBetween($orderedAt, 'now'),
        ];
    }
}