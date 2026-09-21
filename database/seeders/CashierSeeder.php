<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CashierSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => 'kasir123',
            'role' => 'cashier',
            'phone' => '081234567890',
            'shift' => 'morning',
        ]);
    }
}
