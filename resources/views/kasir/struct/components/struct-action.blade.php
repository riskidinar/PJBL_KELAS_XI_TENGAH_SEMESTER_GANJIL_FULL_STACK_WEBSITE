@php
    $paperSize = $paperSize ?? '58mm'; // 80mm | 58mm
@endphp

<div class="bg-white rounded-2xl border border-slate-200 px-5 py-4 flex flex-wrap items-center justify-between gap-3">

    <div class="flex items-center gap-3">
        <button type="button" class="flex items-center gap-1.5 text-sm font-medium text-slate-600 bg-slate-100 px-3 py-2 rounded-lg hover:bg-slate-200">
            <span class="leading-none">🌗</span> {{ __('Normal') }}
        </button>
        <button type="button" onclick="window.print()" class="flex items-center gap-1.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-lg">
            <span class="leading-none">🖨️</span> {{ __('Print Now') }}
        </button>
    </div>

    <div class="flex bg-slate-100 rounded-lg p-1 text-sm font-medium">
        <button type="button" class="px-4 py-1.5 rounded-md {{ $paperSize === '80mm' ? 'bg-white shadow-sm text-slate-800' : 'text-slate-500' }}">
            {{ __('80mm Roll') }}
        </button>
        <button type="button" class="px-4 py-1.5 rounded-md {{ $paperSize === '58mm' ? 'bg-white shadow-sm text-slate-800' : 'text-slate-500' }}">
            {{ __('58mm Pocket') }}
        </button>
    </div>

</div>
