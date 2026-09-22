@php
    $menus = [
        ['label' => __('Dashboard'), 'route' => 'admin.dashboard.index', 'icon' => 'dashbord_admin.png'],
        ['label' => __('Fruits'), 'route' => 'admin.fruits.index', 'icon' => 'fruit_admin.png'],
        ['label' => __('Cashiers'), 'route' => 'admin.kasir.index', 'icon' => 'kasir_admin.png'],
        ['label' => __('Transaction History'), 'route' => 'admin.history.index', 'icon' => 'transaksi_admin.png'],
    ];
@endphp

<aside class="w-64 shrink-0 h-screen bg-white border-r border-slate-200 flex flex-col">

    {{-- Logo --}}
    <div class="h-16 flex items-center gap-2 px-5 border-b border-slate-200">
        <img src="{{ asset('img/logo.png') }}" alt="Matrif" class="w-8 h-8">
        <div class="leading-tight">
            <p class="font-bold text-sm tracking-wide">MATRIF</p>
            <p class="text-[10px] text-slate-400 tracking-wider -mt-0.5">FRUIT POS</p>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-3 py-4 space-y-1">
        @foreach ($menus as $menu)
            @php $active = request()->routeIs($menu['route']); @endphp
            <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                       {{ $active
            ? 'bg-emerald-600 text-white'
            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                <span class="w-5 h-5 flex items-center justify-center">
                    @if (str_ends_with($menu['icon'], '.png'))
                        <img src="{{ asset('icons/' . $menu['icon']) }}" alt="{{ $menu['label'] }}"
                            class="w-5 h-5 object-contain {{ $active ? 'brightness-0 invert' : 'brightness-0' }}">
                    @else
                        {{ $menu['icon'] }}
                    @endif
                </span>
                {{ $menu['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- User card + logout, ditempel di bawah sidebar --}}
    <div class="p-3 border-t border-slate-200">
        <x-admin.user-card />
    </div>

</aside>
