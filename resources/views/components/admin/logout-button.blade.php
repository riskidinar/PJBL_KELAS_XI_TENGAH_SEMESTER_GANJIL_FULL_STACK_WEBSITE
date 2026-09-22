<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button
        type="submit"
        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
        onclick="return confirm('{{ __('Are you sure you want to log out?') }}')"
        title="{{ __('Logout') }}">
        <span class="w-7 h-7 flex items-center justify-center"><img src="{{ asset('icons/logout_admin.png') }}" alt="{{ __('Logout') }}" class="w-8 h-8 object-contain translate-y-0.5" ></span>
        <span>{{ __('Logout') }}</span>
    </button>
</form>
