@php
    $products = $products ?? [];
@endphp

<div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs font-semibold text-slate-400 tracking-wide border-b border-slate-100">
                <th class="py-3 pl-8 pr-6 font-semibold">{{ __('PLU & PRODUCE ITEM') }}</th>
                <th class="py-3 px-6 font-semibold">{{ __('Table Category') }}</th>
                <th class="py-3 px-6 font-semibold text-right">{{ __('VOLUME') }} /<br>{{ __('WEIGHT SOLD') }}</th>
                <th class="py-3 px-6 font-semibold text-right">{{ __('GROSS') }}<br>{{ __('REVENUE') }}</th>
                <th class="py-3 pl-6 pr-8 font-semibold">{{ __('STOCK TURNOVER') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                @include('kasir.scale.components.scale-row', ['product' => $product])
            @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-slate-400">{{ __('Belum ada data buah.') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
