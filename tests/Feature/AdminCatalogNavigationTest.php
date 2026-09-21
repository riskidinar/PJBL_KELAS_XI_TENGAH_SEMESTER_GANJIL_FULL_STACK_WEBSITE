<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminCatalogNavigationTest extends TestCase
{
    public function test_admin_fruits_page_renders(): void
    {
        $response = $this->get(route('admin.fruits.index'));

        $response->assertOk();
        $response->assertSee('Fruit Inventory & Stock Management');
    }

    public function test_admin_fruit_create_and_cashier_create_pages_render(): void
    {
        $fruitResponse = $this->get(route('admin.fruits.create'));
        $cashierResponse = $this->get(route('admin.kasir.create'));

        $fruitResponse->assertOk();
        $cashierResponse->assertOk();
    }
}
