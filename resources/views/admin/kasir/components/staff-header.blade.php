<div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ __('Cashier Staff & Shift Management') }}</h1>
        <p class="text-slate-400 mt-1 max-w-2xl">
            {{ __('Manage register authorization, terminal assignments, dynamic weigh-station privileges, and real-time shift sales performance.') }}
        </p>
    </div>

    <a href="{{ route('admin.kasir.create') }}"
       class="shrink-0 flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-5 py-3 rounded-xl transition whitespace-nowrap">
        <span class="leading-none"><img src="{{ asset('icons/add_kasir_form.png') }}" class="w-5 h-5 object-contain"></span> {{ __('Add New Cashier') }}
    </a>

</div>
