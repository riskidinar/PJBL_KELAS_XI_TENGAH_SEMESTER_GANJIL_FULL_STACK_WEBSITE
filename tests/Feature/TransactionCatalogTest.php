<?php

namespace Tests\Feature;

use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_cashier_transaction_page_displays_fruits_from_catalog(): void
    {
        Fruit::query()->create([
            'code' => 'FRUIT001',
            'name' => 'Mango Harum Manis',
            'category' => 'Bananas & Tropical',
            'price' => 28500,
            'stock' => 8.5,
            'unit' => 'kg',
            'minimum_stock' => 3,
        ]);

        $response = $this->get(route('kasir.transaction.index'));

        $response->assertStatus(200);
        $response->assertSee('Mango Harum Manis');
        $response->assertSee('FRUIT001');
        $response->assertSee('28.500');
    }
}
