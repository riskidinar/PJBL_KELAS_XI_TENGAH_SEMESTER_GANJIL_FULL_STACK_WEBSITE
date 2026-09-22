@php
    $cashier = auth()->user();
    $cashierName = $cashier?->name ?? 'Kasir';
    $cashierInitials = collect(explode(' ', trim($cashierName)))
        ->filter()
        ->map(fn (string $name): string => strtoupper(substr($name, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<div class="flex items-center gap-2 px-2 py-1.5">
    <div class="relative shrink-0">
        @if (!empty($cashier?->avatar_url))
            <img
                src="{{ $cashier->avatar_url }}"
                alt="{{ $cashierName }}"
                class="w-9 h-9 rounded-full object-cover"
            >
        @else
            <span class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 text-xs font-bold flex items-center justify-center">
                {{ $cashierInitials }}
            </span>
        @endif
        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white"></span>
    </div>
    <div class="leading-tight">
        <p class="text-sm font-semibold text-slate-700">{{ $cashierName }}</p>
        <p class="text-xs text-slate-400">Shift 1 Active</p>
    </div>
</div>
