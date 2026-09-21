{{--
    Satu baris staf kasir. Dipanggil dari staff-table.blade.php dengan
    @include(..., ['staff' => $staff]).
    $staff: avatar_url (null kalau belum ada foto -> pakai inisial),
    initials, name, code, email, role, register_name, register_note,
    status ('active'|'break'|'scheduled'|'off'|'inactive'), status_label,
    shift_note, sales_amount (null kalau belum mulai shift), sales_note,
    scale_accuracy_percent (null kalau cuma rata-rata), scale_accuracy_label,
    activity_label, activity_time
--}}
@php
    $statusStyles = [
        'active'    => ['dot' => 'bg-emerald-500', 'text' => 'text-emerald-600'],
        'break'     => ['dot' => 'bg-orange-400',  'text' => 'text-orange-500'],
        'scheduled' => ['dot' => 'bg-sky-400',      'text' => 'text-sky-600'],
        'off'       => ['dot' => 'bg-slate-300',    'text' => 'text-slate-400'],
        'inactive'  => ['dot' => 'bg-slate-300',    'text' => 'text-slate-400'],
    ];
    $style = $statusStyles[$staff['status']] ?? $statusStyles['off'];
    $onlineDot = in_array($staff['status'], ['active']) ? 'bg-emerald-500' : (($staff['status'] === 'break') ? 'bg-orange-400' : 'bg-slate-300');
@endphp

<tr class="border-b border-slate-100 align-top hover:bg-slate-50/60">

    {{-- Staff Member --}}
    <td class="py-4 pl-5 pr-4">
        <div class="flex items-center gap-3">
            <div class="relative shrink-0">
                @if (!empty($staff['avatar_url']))
                    <img src="{{ $staff['avatar_url'] }}" alt="{{ $staff['name'] }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <span class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 text-xs font-bold flex items-center justify-center">
                        {{ $staff['initials'] }}
                    </span>
                @endif
                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white {{ $onlineDot }}"></span>
            </div>
            <div>
                <p class="font-semibold text-slate-800 leading-tight">{{ $staff['name'] }}</p>
                <p class="text-xs text-slate-400">{{ $staff['code'] }}</p>
                <p class="text-xs text-slate-400">• {{ $staff['email'] }}</p>
            </div>
        </div>
    </td>

    {{-- Role System --}}
    <td class="py-4 pr-4 whitespace-nowrap">
        <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full">{{ $staff['role'] }}</span>
    </td>

    {{-- Register Station --}}
    <td class="py-4 pr-4 ">
        <p class="font-semibold text-slate-800 text-sm">{{ $staff['register_name'] }}</p>
        @if(!empty($staff['register_note']))
            <p class="text-xs text-slate-400">{{ $staff['register_note'] }}</p>
        @endif
    </td>

    {{-- Shift & Working State --}}
    <td class="py-4 pr-4 ">
        <p class="text-sm font-semibold flex items-center gap-1.5 {{ $style['text'] }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $style['dot'] }}"></span> {{ $staff['status_label'] }}
        </p>
        @if(!empty($staff['shift_note']))
            <p class="text-xs text-slate-400 mt-0.5">{{ $staff['shift_note'] }}</p>
        @endif
    </td>

    {{-- Today's Sales (TRX) --}}
    <td class="py-4 pr-4 whitespace-nowrap">
        @if ($staff['sales_amount'] !== null)
            <p class="font-bold text-slate-800">Rp {{ number_format($staff['sales_amount'], 0, ',', '.') }}</p>
            <p class="text-xs text-emerald-600">{{ $staff['sales_note'] }}</p>
        @else
            <p class="text-sm text-slate-400">{{ $staff['sales_note'] ?? '-' }}</p>
        @endif
    </td>

    {{-- Scale Accuracy --}}
    <td class="py-4 pr-4 ">
        <div class="flex items-center gap-2">
            <span class="text-sm font-semibold text-emerald-600 whitespace-nowrap">{{ $staff['scale_accuracy_label'] }}</span>
            @if ($staff['scale_accuracy_percent'] !== null)
                <div class="h-1.5 flex-1 rounded-full bg-slate-100">
                    <div class="h-1.5 rounded-full bg-emerald-500" style="width: {{ $staff['scale_accuracy_percent'] }}%"></div>
                </div>
            @endif
        </div>
    </td>

    {{-- Activity Log --}}
    <td class="py-4 pr-4 whitespace-nowrap">
        <p class="text-sm font-semibold text-slate-700">{{ $staff['activity_label'] }}</p>
        <p class="text-xs text-slate-400">{{ $staff['activity_time'] }}</p>
    </td>

    {{-- Actions --}}
    <td class="py-4 pr-5 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.kasir.edit', $staff['id'] ?? 0) }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100" title="Edit">
                📝
            </a>
            <form method="POST" action="{{ route('admin.kasir.destroy', $staff['id'] ?? 0) }}" onsubmit="return confirm('Hapus staf kasir ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-50" title="Hapus">
                    🗑️
                </button>
            </form>
        </div>
    </td>

</tr>