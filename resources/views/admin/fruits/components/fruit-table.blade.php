@php
    // Ganti dengan $fruits, $selectedCount, $liveScale dari controller
    $selectedCount = $selectedCount ?? 0;
    $liveScale = $liveScale ?? ['active' => true, 'label' => 'ACTIVE NET SCALE 01'];

    $fruits = $fruits ?? [
        [
            'id' => 1, 'code' => 'FRUIT001', 'image' => asset('images/products/cavendish-banana.jpg'),
            'name' => 'Cavendish Banana', 'category' => 'Bananas & Tropical', 'unit' => 'kg', 'unit_price' => 18000,
            'current_stock_label' => '45.5 kg', 'deficit_label' => null, 'stock_percent' => 80,
            'status' => 'available', 'status_label' => 'Stock Available', 'updated_label' => 'Today, 10:24 AM',
        ],
        [
            'id' => 2, 'code' => 'FRUIT002', 'image' => asset('images/products/sunkist-orange.jpg'),
            'name' => 'Sunkist Navel Orange', 'category' => 'Citrus & Oranges', 'unit' => 'kg', 'unit_price' => 32000,
            'current_stock_label' => '22.0 kg', 'deficit_label' => null, 'stock_percent' => 55,
            'status' => 'available', 'status_label' => 'Stock Available', 'updated_label' => 'Today, 09:12 AM',
        ],
        [
            'id' => 3, 'code' => 'FRUIT003', 'image' => asset('images/products/harum-manis-mango.jpg'),
            'name' => 'Harum Manis Mango', 'category' => 'Bananas & Tropical', 'unit' => 'kg', 'unit_price' => 28500,
            'current_stock_label' => '8.5 kg', 'deficit_label' => '-6.5 kg', 'stock_percent' => 18,
            'status' => 'low', 'status_label' => 'Low Stock', 'updated_label' => 'Yesterday, 04:30 PM',
        ],
        [
            'id' => 4, 'code' => 'FRUIT004', 'image' => asset('images/products/fuji-apple.jpg'),
            'name' => 'Fuji Apple Premium', 'category' => 'Apples & Pears', 'unit' => 'kg', 'unit_price' => 42000,
            'current_stock_label' => '35.0 kg', 'deficit_label' => null, 'stock_percent' => 70,
            'status' => 'available', 'status_label' => 'Stock Available', 'updated_label' => 'Today, 08:00 AM',
        ],
        [
            'id' => 5, 'code' => 'FRUIT005', 'image' => asset('images/products/strawberry.jpg'),
            'name' => 'Sweet Strawberries', 'category' => 'Berries & Melons', 'unit' => 'pack', 'unit_price' => 15000,
            'current_stock_label' => '14 packs', 'deficit_label' => null, 'stock_percent' => 60,
            'status' => 'available', 'status_label' => 'Stock Available', 'updated_label' => 'Today, 07:45 AM',
        ],
        [
            'id' => 6, 'code' => 'FRUIT006', 'image' => asset('images/products/mango.jpg'),
            'name' => 'Alphonso Mango', 'category' => 'Bananas & Tropical', 'unit' => 'kg', 'unit_price' => 55000,
            'current_stock_label' => '0.0 kg', 'deficit_label' => null, 'stock_percent' => 0,
            'status' => 'out', 'status_label' => 'Out of Stock', 'updated_label' => '2 days ago', 'faded' => true,
        ],
        [
            'id' => 7, 'code' => 'FRUIT007', 'image' => asset('images/products/honey-melon.jpg'),
            'name' => 'Honey Melon Sun', 'category' => 'Berries & Melons', 'unit' => 'kg', 'unit_price' => 21000,
            'current_stock_label' => '4.2 kg', 'deficit_label' => '-5.8 kg', 'stock_percent' => 12,
            'status' => 'low', 'status_label' => 'Low Stock', 'updated_label' => 'Yesterday, 06:15 PM',
        ],
        [
            'id' => 8, 'code' => 'FRUIT008', 'image' => asset('images/products/dragon-fruit.jpg'),
            'name' => 'Dragon Fruit Red', 'category' => 'Exotic', 'unit' => 'kg', 'unit_price' => 24000,
            'current_stock_label' => '19.0 kg', 'deficit_label' => null, 'stock_percent' => 50,
            'status' => 'available', 'status_label' => 'Stock Available', 'updated_label' => 'Today, 11:05 AM',
        ],
    ];
@endphp

{{-- Toolbar: Select All + Live Scale Sync --}}
<div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
    <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
        <input type="checkbox" id="select-all-fruits" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
        Select All Items
        <span class="text-slate-300">|</span>
        <span id="selected-count-label">{{ $selectedCount }} selected</span>
    </label>

    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span>{{ __('Live Scale Sync') }}:</span>
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold {{ $liveScale['active'] ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }} px-3 py-1.5 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full {{ $liveScale['active'] ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
            {{ $liveScale['label'] }}
        </span>
    </div>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs font-semibold text-slate-400 tracking-wide border-b border-slate-100">
                <th class="py-3 pl-5 pr-3"></th>
                <th class="py-3 pr-4">{{ __('Table Fruit Code') }}</th>
                <th class="py-3 pr-4">{{ __('FRUIT PRODUCT') }}</th>
                <th class="py-3 pr-4">{{ __('UNIT') }}</th>
                <th class="py-3 pr-4">{{ __('UNIT') }}<br>{{ __('PRICE') }}</th>
                <th class="py-3 pr-4">{{ __('CURRENT STOCK') }}</th>
                <th class="py-3 pr-4">{{ __('STOCK') }}<br>{{ __('STATUS') }}</th>
                <th class="py-3 pr-4">{{ __('LAST') }}<br>{{ __('UPDATED') }}</th>
                <th class="py-3 pr-5">{{ __('ACTIONS') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fruits as $fruit)
                @include('admin.fruits.components.fruit-row', ['fruit' => $fruit])
            @empty
                <tr>
                    <td colspan="9" class="py-10 text-center text-slate-400">Belum ada data buah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
