@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-gray-200">
    <div class="px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold text-gray-900">Finance Management</h1>
        <div class="flex items-center gap-4">
            <button class="px-4 py-2.5 bg-[#FFCC00]-600 text-white rounded-lg hover:bg-[#FFCC00]-700 flex items-center gap-2 font-medium shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Generate Report
            </button>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 w-64 bg-gray-100 border-0 rounded-lg text-sm focus:ring-2 focus:ring-[#FFCC00]-500 focus:bg-white transition">
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-6">
    <!-- Stats Row -->
    <div class="grid grid-cols-5 gap-4 mb-6">
        <!-- Total Expenses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Expenses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_expenses'] }}</p>
                    <p class="text-xs text-yellow-600 font-semibold mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        8.5% Up from last month
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Payroll Cost -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Payroll Cost</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['payroll_cost'] }}</p>
                    <p class="text-xs text-yellow-600 font-semibold mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        1.3% Up from last month
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#FFCC00]-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#FFCC00]-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Pending Requests</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_requests'] }}</p>
                    <div class="text-xs text-gray-500 mt-2 space-y-0.5">
                        <p>{{ $stats['expenses_count'] }} expenses</p>
                        <p>{{ $stats['payroll_entries'] }} payroll entries</p>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Last Report -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Last Report</p>
                    <p class="text-lg font-bold text-gray-900">Generated</p>
                    <p class="text-sm text-[#FFCC00]-600 font-semibold mt-2">{{ $stats['last_report'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#FFCC00]-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#FFCC00]-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!--Funds Released -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Funds Released</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['funds_released'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">Total funds released to date</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <!-- Tab Headers -->
        <div class="border-b border-gray-200">
            <nav class="flex gap-8 px-6" id="financeTabs">
                <button onclick="switchTab('payroll')" class="finance-tab active py-4 px-1 border-b-2 border-[#FFCC00]-600 font-semibold text-sm text-[#FFCC00]-600 transition">
                    Payroll Request
                </button>
                <button onclick="switchTab('expense')" class="finance-tab py-4 px-1 border-b-2 border-transparent font-semibold text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition">
                    Expense Request
                </button>
                <button onclick="switchTab('manual')" class="finance-tab py-4 px-1 border-b-2 border-transparent font-semibold text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition">
                    Manual Record
                </button>
            </nav>
        </div>

        <!-- Info Banner -->
        <div class="px-6 py-3 bg-[#FFCC00]-50 border-b border-[#FFCC00]-100">
            <p class="text-xs text-[#FFCC00]-800">
                <span class="font-semibold">Note:</span> Requests marked as Complete are saved as paid and will appear in finance summary reports.
            </p>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Payroll Request Tab -->
            <div id="payrollTab" class="tab-content">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50">
                                <th class="text-left py-3 px-4 rounded-tl-lg">Name</th>
                                <th class="text-left py-3 px-4">Files/Proof</th>
                                <th class="text-left py-3 px-4">Check</th>
                                <th class="text-left py-3 px-4">Rate</th>
                                <th class="text-left py-3 px-4">Date</th>
                                <th class="text-left py-3 px-4 rounded-tr-lg">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($payrollRequests as $request)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-4 font-semibold text-sm text-gray-900">{{ $request->name }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs text-gray-600">{{ $request->file_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <button class="text-[#FFCC00]-600 hover:text-[#FFCC00]-700 font-semibold text-sm flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        VIEW
                                    </button>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1.5 bg-[#FFCC00]-50 text-[#FFCC00]-700 rounded-lg text-sm font-semibold">{{ $request->rate }}</span>
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-600">{{ $request->date->format('m-d-y') }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ route('finance.payroll.complete', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-semibold flex items-center gap-1.5 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Complete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Expense Request Tab -->
            <div id="expenseTab" class="tab-content hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50">
                                <th class="text-left py-3 px-4 rounded-tl-lg">Materials</th>
                                <th class="text-left py-3 px-4">Quantity (Stock-in)</th>
                                <th class="text-left py-3 px-4">Price per Unit</th>
                                <th class="text-left py-3 px-4">Total</th>
                                <th class="text-left py-3 px-4">Date</th>
                                <th class="text-left py-3 px-4 rounded-tr-lg">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($expenseRequests as $request)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-4 font-semibold text-sm text-gray-900">{{ $request->materials }}</td>
                                <td class="py-4 px-4 text-sm text-gray-900">{{ $request->quantity }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm text-gray-700">{{ $request->price_per_unit }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1.5 bg-[#FFCC00]-50 text-[#FFCC00]-700 rounded-lg text-sm font-semibold">{{ $request->total }}</span>
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-600">{{ $request->date->format('m-d-y') }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ route('finance.expense.complete', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-semibold flex items-center gap-1.5 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Complete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Manual Record Tab -->
            <div id="manualTab" class="tab-content hidden">
                <div class="grid grid-cols-12 gap-6">
                    <!-- Form Column -->
                    <div class="col-span-5">
                        <form action="{{ route('finance.manual-record.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Expense Name</label>
                                <input type="text" name="materials" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFCC00]-500 focus:border-transparent transition text-sm" placeholder="Enter expense name">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                                <input type="date" name="date" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFCC00]-500 focus:border-transparent transition text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity (Stock-in)</label>
                                <input type="text" name="quantity" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFCC00]-500 focus:border-transparent transition text-sm" placeholder="Enter quantity">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Requested by</label>
                                <input type="text" name="requested_by" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFCC00]-500 focus:border-transparent transition text-sm" placeholder="Enter name">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Price per unit</label>
                                <input type="text" name="price_per_unit" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FFCC00]-500 focus:border-transparent transition text-sm" placeholder="₱0.00">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Total</label>
                                <input type="text" name="total" required disabled class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-sm" placeholder="₱0.00">
                            </div>

                            <button type="submit" class="w-full px-4 py-3 bg-[#FFCC00]-600 text-white rounded-lg hover:bg-[#FFCC00]-700 transition font-semibold text-sm shadow-sm flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Save
                            </button>
                        </form>
                    </div>

                    <!-- Charts Column -->
                    <div class="col-span-7 space-y-6">
                        <!-- Pie Chart Placeholder -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-4">Payroll Distribution by Project this Month</h3>
                            <div class="h-48 flex items-center justify-center bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Chart visualization placeholder</p>
                            </div>
                        </div>

                        <!-- Bar Chart Placeholder -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-4">Payroll Expenses - Past Five Months</h3>
                            <div class="h-48 flex items-center justify-center bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Chart visualization placeholder</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    //Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    //Remove active class from all tab buttons
    document.querySelectorAll('.finance-tab').forEach(button => {
        button.classList.remove('active', 'border-[#FFCC00]-600', 'text-[#FFCC00]-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    //Show selected tab
    if (tabName === 'payroll') {
        document.getElementById('payrollTab').classList.remove('hidden');
        event.target.classList.add('active', 'border-[#FFCC00]-600', 'text-[#FFCC00]-600');
        event.target.classList.remove('border-transparent', 'text-gray-500');
    } else if (tabName === 'expense') {
        document.getElementById('expenseTab').classList.remove('hidden');
        event.target.classList.add('active', 'border-[#FFCC00]-600', 'text-[#FFCC00]-600');
        event.target.classList.remove('border-transparent', 'text-gray-500');
    } else if (tabName === 'manual') {
        document.getElementById('manualTab').classList.remove('hidden');
        event.target.classList.add('active', 'border-[#FFCC00]-600', 'text-[#FFCC00]-600');
        event.target.classList.remove('border-transparent', 'text-gray-500');
    }
}
</script>

<style>
.finance-tab.active {
    border-color: #2563eb;
    color: #2563eb;
}
</style>
@endsection