@php
    // Ganti dengan $products dari controller (idealnya hasil ->paginate(20))
    $products = $products ?? [
        [
            'image' => asset('images/products/cavendish-banana.jpg'),
            'name' => 'Cavendish Premium Banana', 'plu' => '4011', 'unit_note' => 'Per Kg',
            'category' => 'Tropical', 'category_sub' => 'Fresh',
            'volume' => '680,4', 'volume_unit' => 'kg', 'revenue' => 12240000,
            'days_remaining' => 1.4, 'turnover_status' => 'fast', 'turnover_percent' => 80,
        ],
        [
            'image' => asset('images/products/ponkan-mandarin.jpg'),
            'name' => 'Ponkan Honey Mandarin', 'plu' => '3107', 'unit_note' => 'Per Kg',
            'category' => 'Citrus &', 'category_sub' => 'Oranges',
            'volume' => '512,0', 'volume_unit' => 'kg', 'revenue' => 17920000,
            'days_remaining' => 2.8, 'turnover_status' => 'optimal', 'turnover_percent' => 55,
        ],
        [
            'image' => asset('images/products/fuji-apple.jpg'),
            'name' => 'Fuji Apple Select Grade A', 'plu' => '4131', 'unit_note' => 'Per Kg',
            'category' => 'Apples &', 'category_sub' => 'Pears',
            'volume' => '445,2', 'volume_unit' => 'kg', 'revenue' => 19588800,
            'days_remaining' => 4.5, 'turnover_status' => 'stable', 'turnover_percent' => 40,
        ],
        [
            'image' => asset('images/products/strawberry.jpg'),
            'name' => 'Sweet Strawberry Clamshell', 'plu' => '9204', 'unit_note' => '250g Clamshell',
            'category' => 'Berries &', 'category_sub' => 'Melons',
            'volume' => '240', 'volume_unit' => 'Packs', 'revenue' => 9600000,
            'days_remaining' => 0.8, 'turnover_status' => 'critical', 'turnover_percent' => 90,
        ],
        [
            'image' => asset('images/products/dragon-fruit.jpg'),
            'name' => 'Red Flesh Dragon Fruit', 'plu' => '3040', 'unit_note' => 'Per Kg',
            'category' => 'Exotic &', 'category_sub' => 'Specialty',
            'volume' => '320,5', 'volume_unit' => 'kg', 'revenue' => 8012500,
            'days_remaining' => 2.1, 'turnover_status' => 'fast', 'turnover_percent' => 68,
        ],
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs font-semibold text-slate-400 tracking-wide border-b border-slate-100">
                <th class="py-3 pl-5 pr-4 font-semibold">{{ __('PLU & PRODUCE ITEM') }}</th>
                <th class="py-1 pr-1 font-semibold">{{ __('Table Category') }}</th>
                <th class="py-1 pr-1 font-semibold text-right">{{ __('VOLUME') }} /<br>{{ __('WEIGHT SOLD') }}</th>
                <th class="py-3 pr-4 font-semibold text-right">{{ __('GROSS') }}<br>{{ __('REVENUE') }}</th>
                <th class="py-3 pr-4 font-semibold">{{ __('STOCK TURNOVER') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                @include('kasir.scale.components.scale-row', ['product' => $product])
            @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-slate-400">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
