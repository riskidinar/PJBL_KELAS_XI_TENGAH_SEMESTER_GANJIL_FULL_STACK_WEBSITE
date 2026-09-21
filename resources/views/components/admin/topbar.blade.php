
<header class="h-16 shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-6">

    <button
        type="button"
        class="flex items-center gap-2 text-sm font-medium text-slate-600 bg-slate-50 hover:bg-slate-100 px-3 py-1.5 rounded-lg transition"
    >
        <span class="leading-none">🏬</span>
        {{ auth()->user()->currentStore->name ?? __('Store').' MATRIF Central' }}
        <span class="text-slate-400 text-xs">▾</span>
    </button>

    <form method="POST" action="{{ route('locale.update') }}" class="flex items-center bg-slate-50 rounded-full p-1 text-xs font-bold" aria-label="{{ __('Language') }}">
        @csrf
        @foreach (['id' => 'ID', 'en' => 'EN'] as $locale => $label)
            <button
                type="submit"
                name="locale"
                value="{{ $locale }}"
                class="px-3 py-1 rounded-full transition {{ app()->getLocale() === $locale ? 'bg-emerald-600 text-white' : 'text-slate-400 hover:text-slate-600' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </form>

</header>
