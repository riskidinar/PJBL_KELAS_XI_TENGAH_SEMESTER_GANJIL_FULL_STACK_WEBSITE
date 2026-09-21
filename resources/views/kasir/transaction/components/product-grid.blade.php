@php
    // Dummy data mengikuti contoh desain — ganti dengan $products dari controller
    $products = $products ?? collect(range(1, 6))->map(fn ($i) => [
        'id' => $i,
        'code' => 'F8909KH',
        'stock_label' => '45.5 kg Tersedia',
        'image' => asset('images/products/cavendish-banana.jpg'),
        'category' => 'Bananas',
        'name' => 'Cavendish Banana',
        'price' => 18000,
        'unit' => 'kg',
        'in_stock' => true,
    ])->push([
        'id' => 7,
        'code' => 'F8909KH',
        'stock_label' => 'Slot Habis',
        'image' => asset('images/products/mango.jpg'),
        'category' => 'Tropical',
        'name' => 'Alphonso Mango',
        'price' => 55000,
        'unit' => 'kg',
        'in_stock' => false,
    ])->push([
        'id' => 8,
        'code' => 'F8909KH',
        'stock_label' => '4.2 kg Rendah',
        'image' => asset('images/products/honey-melon.jpg'),
        'category' => 'Melons',
        'name' => 'Honey Melon Sun',
        'price' => 21000,
        'unit' => 'kg',
        'in_stock' => true,
    ]);
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($products as $product)
        @include('kasir.transaction.components.product-card', ['product' => $product])
    @endforeach
</div>