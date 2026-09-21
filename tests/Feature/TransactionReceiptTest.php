<?php

namespace Tests\Feature;

use Tests\TestCase;

class TransactionReceiptTest extends TestCase
{
    public function test_completed_transaction_redirects_to_receipt_with_payment_data(): void
    {
        $response = $this->post(route('kasir.transaction.store'), [
            'amount_received' => 150000,
            'customer_name' => 'Budi Santoso',
            'payment_method' => 'cash',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('receipt.payment_amount', 150000);
        $response->assertSessionHas('receipt.customer', 'Budi Santoso');
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
