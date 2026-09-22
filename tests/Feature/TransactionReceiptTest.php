<?php

namespace Tests\Feature;

use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionReceiptTest extends TestCase
{
    use RefreshDatabase;

    public function test_completed_transaction_redirects_to_receipt_with_payment_data(): void
    {
        $fruit = Fruit::query()->create([
            'code' => 'FRUIT001',
            'name' => 'Mango Harum Manis',
            'category' => 'Tropical',
            'price' => 28000,
            'stock' => 8,
            'unit' => 'kg',
            'minimum_stock' => 2,
        ]);

        $response = $this->post(route('kasir.transaction.store'), [
            'amount_received' => 150000,
            'customer_name' => 'Budi Santoso',
            'payment_method' => 'cash',
            'cart_items' => json_encode([
                ['id' => $fruit->id, 'quantity' => 2],
            ]),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('receipt.payment_amount', 150000);
        $response->assertSessionHas('receipt.customer', 'Budi Santoso');
        $response->assertSessionHas('receipt.grand_total', 56000);
        $response->assertSessionHas('receipt.items.0.name', 'Mango Harum Manis');
    }

    public function test_completed_transaction_requires_payment_data(): void
    {
        $response = $this->post(route('kasir.transaction.store'), []);

        $response->assertSessionHasErrors([
            'amount_received',
            'payment_method',
        ]);
    }

    public function test_receipt_page_renders_successfully(): void
    {
        $response = $this->get(route('kasir.struct.index', 'TRX-20260919043006'));

        $response->assertOk();
        $response->assertSee('Transaction Completed');
    }
}
