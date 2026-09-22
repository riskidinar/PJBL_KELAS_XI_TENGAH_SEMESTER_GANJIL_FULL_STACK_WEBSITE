@php
    // Ganti dengan $topMovers dari controller, urut dari turnover tertinggi
    $topMovers = $topMovers ?? [
        ['rank' => 1, 'name' => 'Cavendish Ba...', 'amount' => 864000, 'weight' => '48.0 kg', 'percent' => 100],
        ['rank' => 2, 'name' => 'Sunkist Nav...',   'amount' => 1040000, 'weight' => '32.5 kg', 'percent' => 78],
        ['rank' => 3, 'name' => 'Fuji Apple',       'amount' => 1176000, 'weight' => '28.0 kg', 'percent' => 65],
        ['rank' => 4, 'name' => 'Sweet Straw...',   'amount' => 360000,  'weight' => '24 pks',  'percent' => 45, 'low' => true],
        ['rank' => 5, 'name' => 'Dragon Fruit ...',  'amount' => 468000,  'weight' => '19.5 kg', 'percent' => 30, 'low' => true],
    ];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 p-5 h-full flex flex-col">

    <div class="flex items-center justify-between mb-1">
        <h2 class="font-semibold text-slate-800 text-lg">{{ __('Top Movers') }}</h2>
        <button type="button" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-50" title="{{ __('Refresh') }}">
            <span class="leading-none"><img src="{{ asset('icons/terlaris_admin.png') }}" class="w-4 h-4 object-contain"></span>
        </button>
    </div>
    <p class="text-sm text-slate-400 mb-4">{{ __('Ranked by turnover weight') }}</p>

    <div class="space-y-4 flex-1">
        @foreach ($topMovers as $item)
            <div>
                <div class="flex items-center gap-3 mb-1.5">
                    <span class="w-5 h-5 shrink-0 flex items-center justify-center rounded-full bg-emerald-600 text-white text-[11px] font-bold">
                        {{ $item['rank'] }}
                    </span>
                    <span class="text-sm font-medium text-slate-700 flex-1 truncate">{{ $item['name'] }}</span>
                    <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($item['amount'], 0, ',', '.') }}</span>
                    <span class="text-xs text-slate-400 w-16 text-right">{{ $item['weight'] }}</span>
                </div>
                <div class="h-1.5 rounded-full bg-slate-100 ml-8">
                    <div
                        class="h-1.5 rounded-full {{ $item['low'] ?? false ? 'bg-orange-400' : 'bg-emerald-500' }}"
                        style="width: {{ $item['percent'] }}%"
                    ></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
