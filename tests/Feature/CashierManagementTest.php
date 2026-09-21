<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CashierManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_cashier_account(): void
    {
        $response = $this->post(route('admin.kasir.store'), [
            'full_name' => 'Siti Nurhaliza',
            'email' => 'siti@example.test',
            'password' => 'password123',
            'role' => 'admin',
            'default_shift' => 'shift_2',
            'phone' => '+62 812 0000 1111',
        ]);

        $response->assertRedirect(route('admin.kasir.index'));
        $response->assertSessionHas('status', 'Data kasir berhasil ditambahkan.');
        $this->assertDatabaseHas('users', [
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.test',
            'role' => 'cashier',
            'shift' => 'shift_2',
        ]);
        $this->assertTrue(Hash::check('password123', User::query()->where('email', 'siti@example.test')->firstOrFail()->password));
    }

    public function test_admin_can_update_a_cashier_without_changing_existing_password(): void
    {
        $cashier = User::factory()->create([
            'name' => 'Kasir Lama',
            'email' => 'lama@example.test',
            'password' => 'old-password',
            'role' => 'cashier',
            'shift' => 'shift_1',
        ]);
        $oldPassword = $cashier->password;

        $response = $this->put(route('admin.kasir.update', $cashier->id), [
            'full_name' => 'Kasir Baru',
            'email' => 'baru@example.test',
            'password' => '',
            'default_shift' => 'shift_2',
            'phone' => '081200000000',
        ]);

        $response->assertRedirect(route('admin.kasir.index'));
        $this->assertDatabaseHas('users', [
            'id' => $cashier->id,
            'name' => 'Kasir Baru',
            'email' => 'baru@example.test',
            'shift' => 'shift_2',
            'password' => $oldPassword,
        ]);
    }

    public function test_admin_can_delete_a_cashier_account(): void
    {
        $cashier = User::factory()->create(['role' => 'cashier']);

        $response = $this->delete(route('admin.kasir.destroy', $cashier->id));

        $response->assertRedirect(route('admin.kasir.index'));
        $this->assertDatabaseMissing('users', ['id' => $cashier->id]);
    }

    public function test_admin_account_cannot_be_deleted_through_cashier_route(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->delete(route('admin.kasir.destroy', $admin->id));

        $response->assertNotFound();
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
