
<header class="h-16 shrink-0 bg-white border-b border-slate-200 flex items-center px-6">


    <div class="flex items-center gap-2 text-sm font-medium text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg">
        <span class="text-base">
            <img src="{{ asset('icons/register_kasir_topbar.png') }}" class="w-3 h-3 object-contain">
        </span>

        Register #{{ auth()->user()->register_number ?? '01' }} — {{ __('Online') }}
    </div>
    <div class="flex items-center gap-4 ml-5 text-sm text-slate-500">
        <div class="flex items-center gap-1.5">
            <img src="{{ asset('icons/calender_topbar_kasir.png') }}" class="w-4 h-4 object-contain" alt="Date">
            <span>
                {{ now()->translatedFormat('D, d M Y') }}
            </span>
        </div>
        <div class="flex items-center gap-1.5" id="live-clock" data-time="{{ now()->format('H:i') }}">
            <img src="{{ asset('icons/jam_topbar_kasir.png') }}" class="w-4 h-4 object-contain" alt="Time">
            <span>
                {{ now()->format('H:i A') }}
            </span>
        </div>
    </div>
    <form method="POST" action="{{ route('locale.update') }}"
        class="flex items-center bg-slate-50 rounded-full p-1 text-xs font-bold ml-auto"
        aria-label="{{ __('Language') }}">
        @csrf
        @foreach (['id' => 'ID', 'en' => 'EN'] as $locale => $label)
            <button type="submit" name="locale" value="{{ $locale }}" class="px-3 py-1 rounded-full transition
                        {{ app()->getLocale() === $locale
            ? 'bg-emerald-600 text-white'
            : 'text-slate-400 hover:text-slate-600'
                        }}">
                {{ $label }}
            </button>
        @endforeach
    </form>
</header>

@once
    @push('scripts')
        <script>
            setInterval(() => {
                const el = document.querySelector('#live-clock span:last-child');

                if (el) {
                    el.textContent = new Date().toLocaleTimeString(
                        '{{ app()->getLocale() }}-{{ strtoupper(app()->getLocale()) }}',
                        {
                            hour: '2-digit',
                            minute: '2-digit'
                        }
                    );
                }
            }, 1000 * 30);
        </script>
    @endpush
@endonce
```