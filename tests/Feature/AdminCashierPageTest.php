<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminCashierPageTest extends TestCase
{
    public function test_admin_cashier_index_page_renders(): void
    {
        $response = $this->get(route('admin.kasir.index'));

        $response->assertOk();
        $response->assertSee('Cashier Staff & Shift Management');
    }

    public function test_admin_cashier_create_and_edit_pages_are_reachable(): void
    {
        $createResponse = $this->get(route('admin.kasir.create'));
        $editResponse = $this->get(route('admin.kasir.edit', 1));

        $createResponse->assertOk();
        $editResponse->assertOk();
    }
}
