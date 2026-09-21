<div class="flex items-center gap-2 px-2 py-1.5">
    <div class="relative">
        <img
            src="{{ auth()->user()->avatar_url ?? asset('images/default-avatar.png') }}"
            alt="{{ auth()->user()->name ?? 'Kasir' }}"
            class="w-9 h-9 rounded-full object-cover"
        >
        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white"></span>
    </div>
    <div class="leading-tight">
        <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->name ?? 'Kasir' }}</p>
        <p class="text-xs text-slate-400">Shift 1 Active</p>
    </div>
</div>