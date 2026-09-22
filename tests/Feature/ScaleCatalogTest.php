<?php

namespace Tests\Feature;

use App\Models\Fruit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScaleCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_scale_page_displays_fruits_from_catalog_with_uploaded_image_url(): void
    {
        $fruit = Fruit::query()->create([
            'code' => 'FRUIT001',
            'name' => 'Mango Harum Manis',
            'category' => 'Bananas & Tropical',
            'price' => 28500,
            'stock' => 8.5,
            'unit' => 'kg',
            'minimum_stock' => 3,
            'image' => 'fruits/mango.png',
        ]);

        $response = $this->get(route('kasir.scale.index'));

        $response->assertStatus(200);
        $response->assertSee($fruit->name);
        $response->assertSee($fruit->code);
        $response->assertSee('/storage/fruits/mango.png');
    }
}
