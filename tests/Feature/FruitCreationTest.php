<?php

namespace Tests\Feature;

use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FruitCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_fruit_and_store_it_in_database(): void
    {
        $response = $this->post(route('admin.fruits.store'), [
            'fruit_name' => 'Mango Harum Manis',
            'category_id' => 1,
            'unit' => 'kg',
            'unit_price' => 28500,
            'initial_stock' => 8.5,
            'min_stock_alert' => 3,
        ]);

        $response->assertRedirect(route('admin.fruits.index'));
        $response->assertSessionHas('status', 'Data buah berhasil ditambahkan.');

        $this->assertDatabaseHas('fruits', [
            'code' => 'FRUIT001',
            'name' => 'Mango Harum Manis',
            'price' => 28500,
            'stock' => 8.5,
            'unit' => 'kg',
            'minimum_stock' => 3,
            'image' => null,
        ]);

        $this->assertSame(1, Fruit::query()->count());
    }

    public function test_fruit_creation_requires_the_catalog_fields(): void
    {
        $response = $this->post(route('admin.fruits.store'), []);

        $response->assertSessionHasErrors([
            'fruit_name',
            'category_id',
            'unit',
            'unit_price',
            'initial_stock',
            'min_stock_alert',
        ]);
    }

    public function test_admin_can_update_a_fruit(): void
    {
        $fruit = Fruit::query()->create([
            'code' => 'FRUIT001',
            'name' => 'Apel Lama',
            'category' => 'Apples & Pears',
            'price' => 20000,
            'stock' => 5,
            'unit' => 'kg',
            'minimum_stock' => 2,
        ]);

        $response = $this->put(route('admin.fruits.update', $fruit->id), [
            'fruit_name' => 'Apel Fuji',
            'category_id' => 3,
            'unit' => 'g',
            'unit_price' => 25000,
            'initial_stock' => 1200,
            'min_stock_alert' => 500,
        ]);

        $response->assertRedirect(route('admin.fruits.index'));
        $this->assertDatabaseHas('fruits', [
            'id' => $fruit->id,
            'name' => 'Apel Fuji',
            'category' => 'Apples & Pears',
            'unit' => 'g',
            'price' => 25000,
            'stock' => 1200,
            'minimum_stock' => 500,
        ]);
    }

    public function test_admin_can_delete_a_fruit(): void
    {
        $fruit = Fruit::query()->create([
            'code' => 'FRUIT001',
            'name' => 'Buah Hapus',
            'category' => 'Exotic',
            'price' => 10000,
            'stock' => 1,
            'unit' => 'kg',
            'minimum_stock' => 1,
        ]);

        $response = $this->delete(route('admin.fruits.destroy', $fruit->id));

        $response->assertRedirect(route('admin.fruits.index'));
        $this->assertDatabaseMissing('fruits', ['id' => $fruit->id]);
    }
}
