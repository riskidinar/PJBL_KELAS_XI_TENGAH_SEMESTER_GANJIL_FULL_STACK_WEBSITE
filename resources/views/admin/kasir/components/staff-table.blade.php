@php
    // Ganti dengan $staffList dari controller
    $staffList = $staffList ?? [
        [
            'id' => 1, 'avatar_url' => asset('images/avatars/sarah.jpg'), 'initials' => 'SJ',
            'name' => 'Sarah Jenkins', 'code' => 'CSH-001', 'email' => 'sarah.j@matrif.test', 'role' => 'Cashier',
            'register_name' => 'Register #01', 'register_note' => 'Front Produce Hall',
            'status' => 'active', 'status_label' => 'Active Now', 'shift_note' => 'Shift 1 (07:00 - 15:00)',
            'sales_amount' => 2420000, 'sales_note' => '32 completed orders',
            'scale_accuracy_percent' => 99.8, 'scale_accuracy_label' => '99.8%',
            'activity_label' => 'Active 1m ago', 'activity_time' => 'Clock-in: 06:52 AM',
        ],
        [
            'id' => 2, 'avatar_url' => asset('images/avatars/rizki.jpg'), 'initials' => 'RR',
            'name' => 'Rizki Ramadhan', 'code' => 'CSH-002', 'email' => 'rizki.r@matrif.test', 'role' => 'Cashier',
            'register_name' => 'Register #02', 'register_note' => 'Express Checkout Bar',
            'status' => 'active', 'status_label' => 'Active Now', 'shift_note' => 'Shift 1 (07:00 - 15:00)',
            'sales_amount' => 1780000, 'sales_note' => '24 completed orders',
            'scale_accuracy_percent' => 99.4, 'scale_accuracy_label' => '99.4%',
            'activity_label' => 'Active 4m ago', 'activity_time' => 'Clock-in: 07:02 AM',
        ],
        [
            'id' => 3, 'avatar_url' => asset('images/avatars/dewi.jpg'), 'initials' => 'DL',
            'name' => 'Dewi Lestari', 'code' => 'CSH-003', 'email' => 'dewi.l@matrif.test', 'role' => 'Cashier',
            'register_name' => 'Register #03', 'register_note' => 'Bulk & Seasonal Fruits',
            'status' => 'break', 'status_label' => 'On Break', 'shift_note' => 'Shift 1 • Back in 12m',
            'sales_amount' => 650000, 'sales_note' => '8 completed orders',
            'scale_accuracy_percent' => 100, 'scale_accuracy_label' => '100%',
            'activity_label' => 'Break at 11:30 AM', 'activity_time' => 'Clock-in: 07:15 AM',
        ],
        [
            'id' => 4, 'avatar_url' => null, 'initials' => 'DA',
            'name' => 'Dimas Anggara', 'code' => 'CSH-004', 'email' => 'dimas.a@matrif.test', 'role' => 'Cashier',
            'register_name' => 'Register #01', 'register_note' => 'Takes over at 14:30',
            'status' => 'scheduled', 'status_label' => 'Scheduled Shift 2', 'shift_note' => '14:30 - 22:00',
            'sales_amount' => null, 'sales_note' => 'Shift not started',
            'scale_accuracy_percent' => null, 'scale_accuracy_label' => '99.1% (Avg)',
            'activity_label' => 'Yesterday, 10:15 PM', 'activity_time' => '',
        ],
        [
            'id' => 5, 'avatar_url' => null, 'initials' => 'MP',
            'name' => 'Maya Puspita', 'code' => 'CSH-005', 'email' => 'maya.p@matrif.test', 'role' => 'Cashier',
            'register_name' => 'Floating Cashier', 'register_note' => null,
            'status' => 'off', 'status_label' => 'Off Duty Today', 'shift_note' => null,
            'sales_amount' => null, 'sales_note' => '-',
            'scale_accuracy_percent' => null, 'scale_accuracy_label' => '98.9% (Avg)',
            'activity_label' => '2 days ago', 'activity_time' => '',
        ],
    ];
@endphp

<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-xs font-semibold text-slate-400 tracking-wide border-b border-t border-slate-100 bg-slate-50/60">
                <th class="py-3 pl-5 pr-4">{{ __('STAFF MEMBER') }}</th>
                <th class="py-3 pr-4">{{ __('ROLE') }}<br>{{ __('SYSTEM') }}</th>
                <th class="py-3 pr-4">{{ __('REGISTER') }}<br>{{ __('STATION') }}</th>
                <th class="py-3 pr-4">{{ __('SHIFT') }} &<br>{{ __('WORKING STATE') }}</th>
                <th class="py-3 pr-4">{{ __('TODAY\'S') }}<br>{{ __('SALES (TRX)') }}</th>
                <th class="py-3 pr-4">{{ __('SCALE ACCURACY') }}</th>
                <th class="py-3 pr-4">{{ __('ACTIVITY') }}<br>{{ __('LOG') }}</th>
                <th class="py-3 pr-5">{{ __('ACTIONS') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staffList as $staff)
                @include('admin.kasir.components.staff-row', ['staff' => $staff])
            @empty
                <tr>
                    <td colspan="8" class="py-10 text-center text-slate-400">Belum ada data staf kasir.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
