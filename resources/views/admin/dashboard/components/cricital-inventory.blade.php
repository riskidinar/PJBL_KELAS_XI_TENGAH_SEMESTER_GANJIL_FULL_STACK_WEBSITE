@php
    // Ganti dengan $alerts dari controller
    $alerts = $alerts ?? [
        ['name' => 'Alphonso Mango', 'plu' => '#4051', 'bin' => 'Box A-02', 'status' => 'OUT', 'current' => '0.0 kg', 'action' => 'Quick PO'],
        ['name' => 'Honey Melon Sun', 'plu' => '#4312', 'bin' => 'Bin M-04', 'status' => 'LOW', 'min' => '10.0 kg', 'current' => '4.2 kg', 'deficit' => '5.8 kg'],
        ['name' => 'Harum Manis Mango', 'plu' => '#4029', 'bin' => 'Bin A-08', 'status' => 'LOW', 'min' => '15.0 kg', 'current' => '8.5 kg', 'deficit' => '6.5 kg'],
        ['name' => 'Golden Kiwi', 'plu' => '#4911', 'bin' => 'Box K-01', 'status' => 'LOW', 'min' => '12.0 kg', 'current' => '6.0 kg', 'deficit' => '6.0 kg'],
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-5">

    <div class="flex items-center justify-between mb-1">
        <div class="flex items-center gap-2">
            <h2 class="font-semibold text-slate-800 text-lg">{{ __('Critical Inventory Alerts') }}</h2>
            <span class="text-[11px] font-bold bg-red-500 text-white px-2 py-0.5 rounded-md">{{ count($alerts) }} Items</span>
        </div>
        <a href="{{ route('admin.fruits.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-700 flex items-center gap-1">
            Manage Stock <span class="leading-none text-xs">↗️</span>
        </a>
    </div>
    <p class="text-sm text-slate-400 mb-4">{{ __('Replenishment priority for shelf balance') }}</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        @foreach ($alerts as $item)
            @php $out = $item['status'] === 'OUT'; @endphp
            <div class="rounded-xl p-4 {{ $out ? 'bg-red-50 border border-red-100' : 'bg-orange-50 border border-orange-100' }}">

                <div class="flex items-start justify-between mb-1">
                    <p class="font-semibold text-slate-800 leading-tight">{{ $item['name'] }}</p>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md {{ $out ? 'bg-red-500 text-white' : 'bg-orange-400 text-white' }}">
                        {{ $item['status'] }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mb-3">PLU {{ $item['plu'] }} • {{ $item['bin'] }}</p>

                <p class="text-[11px] font-semibold text-slate-400 tracking-wide">
                    {{ $out ? 'CURRENT STOCK' : 'MIN: ' . $item['min'] }}
                </p>

                <div class="flex items-end justify-between mt-1">
                    <p class="text-xl font-bold {{ $out ? 'text-red-600' : 'text-orange-600' }}">{{ $item['current'] }}</p>

                    @if ($out)
                        <button type="button" class="text-xs font-semibold bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600">
                            {{ $item['action'] }}
                        </button>
                    @else
                        <span class="text-xs font-medium text-orange-600">{{ __('Deficit') }}: {{ $item['deficit'] }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

</div>
