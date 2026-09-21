
<div class="flex items-center gap-2 px-1 py-1">
    <img
        src="{{ auth()->user()->avatar_url ?? asset('images/default-avatar.png') }}"
        alt="{{ auth()->user()->name ?? 'Admin' }}"
        class="w-9 h-9 rounded-full object-cover shrink-0"
    >

    <div class="leading-tight flex-1 min-w-0">
        <p class="text-sm font-semibold text-slate-700 truncate">{{ auth()->user()->name ?? 'Marcus Vance' }}</p>
        <p class="text-xs text-slate-400">{{ auth()->user()->role_label ?? 'Terminal Admin' }}</p>
    </div>

    <x-admin.logout-button />
</div>