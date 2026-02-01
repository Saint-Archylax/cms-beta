@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200">
    <div class="px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-900">Team Management</h1>
    </div>
</div>

<!-- Content -->
<div class="p-6">
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Column - Action Cards -->
        <div class="col-span-3 space-y-4">
            <!-- Employee Records Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm text-gray-900">Employee Records</h3>
                        <p class="text-xs text-gray-500 mt-0.5">View employee records.</p>
                    </div>
                </div>
                <a href="{{ route('team.documents') }}" class="block w-full px-4 py-2.5 bg-yellow-600 text-white text-center rounded-lg hover:bg-yellow-700 transition font-medium text-sm shadow-sm">
                    View Documents
                </a>
            </div>

            <!-- Payroll Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm text-gray-900">Payroll</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Review payroll records.</p>
                    </div>
                </div>
                <a href="{{ route('team.payroll') }}" class="block w-full px-4 py-2.5 bg-yellow-600 text-white text-center rounded-lg hover:bg-yellow-700 transition font-medium text-sm shadow-sm">
                    View Payroll
                </a>
            </div>

            <!-- Project Assignment Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm text-gray-900">Project Assignment</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Assign employee to project.</p>
                    </div>
                </div>
                <a href="{{ route('team.assign') }}" class="block w-full px-4 py-2.5 bg-yellow-600 text-white text-center rounded-lg hover:bg-yellow-700 transition font-medium text-sm shadow-sm">
                    Assign Roles
                </a>
            </div>
        </div>

        <!-- Middle Column - Calendar & History -->
        <div class="col-span-6 space-y-6">
            <!-- Calendar -->
            <div class="bg-[#1e293b] text-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-semibold text-base">Calendar</h3>
                    <span class="px-3 py-1.5 bg-[#334155] rounded-lg text-sm font-medium">{{ now()->format('F Y') }}</span>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center">
                    @foreach(['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $day)
                    <div class="text-xs font-semibold text-gray-400 py-2">{{ $day }}</div>
                    @endforeach
                    @for($i = 0; $i < 35; $i++)
                        @php 
                            $day = $i - 1; 
                            $isToday = $day === now()->day - 1;
                        @endphp
                        <div class="py-2.5 rounded-lg text-sm {{ $day >= 0 && $day < 31 ? 'hover:bg-[#334155] cursor-pointer transition ' . ($isToday ? 'bg-yellow-600 font-bold' : '') : 'text-gray-600' }}">
                            {{ $day >= 0 && $day < 31 ? $day + 1 : '' }}
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Verification History -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-semibold text-base text-gray-900 mb-4">Report Verification History</h3>
                <div class="overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-200">
                                <th class="text-left py-3 px-2">Employee</th>
                                <th class="text-left py-3 px-2">Status</th>
                                <th class="text-left py-3 px-2">Date Submitted</th>
                                <th class="text-left py-3 px-2">Date Checked</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($verificationHistory as $history)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-semibold text-xs flex-shrink-0">
                                            {{ $history->teamMember->initials }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $history->teamMember->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2">
                                    @if($history->status === 'Verified')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Verified</span>
                                    @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Denied</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-sm text-gray-600">{{ $history->date_submitted->format('m/d/Y') }}</td>
                                <td class="py-3 px-2 text-sm text-gray-600">{{ $history->date_checked->format('m/d/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column - Team Members -->
        <div class="col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-semibold text-base text-gray-900">Team Members</h3>
                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">{{ $teamMembers->count() }}</span>
                </div>
                <div class="space-y-2 max-h-[calc(100vh-200px)] overflow-y-auto">
                    @foreach($teamMembers as $member)
                    <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition group">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-semibold text-sm flex-shrink-0 group-hover:bg-yellow-600 group-hover:text-white transition">
                            {{ $member->initials }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-gray-900 truncate">{{ $member->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $member->role }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-yellow-600 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection