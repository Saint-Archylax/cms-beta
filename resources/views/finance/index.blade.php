@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#ECECEC] px-8 py-8">
    <!--heder row-->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-900">Finance Management</h1>
            <button
                type="button"
                class="inline-flex items-center gap-2 rounded-md bg-[#FFCC00] px-4 py-2 text-sm font-semibold text-black shadow hover:brightness-95 transition"
            >
                <span class="inline-flex items-center justify-center w-7 h-7 rounded bg-[#FFCC00] border border-black/20">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                        <path d="M7 3h7l3 3v15a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M14 3v4h4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                Generate Report
            </button>
        </div>

        <!--serch right-->
        <div class="w-[520px] max-w-full">
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search"
                    class="w-full rounded-full border border-gray-400 bg-[#EDEDED] px-5 py-2 pr-12 text-sm outline-none"
                >
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
        <!--total expense-->
        <div class="rounded-2xl bg-[#3E3E3E] p-5 shadow-[0_12px_24px_rgba(0,0,0,0.18)]">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-300 text-sm">Total Expenses</p>
                    <p class="text-white text-2xl font-bold mt-2">{{ $stats['total_expenses'] ?? '₱0' }}</p>
                    <p class="text-xs text-gray-300 mt-3">All approved expenses this period</p>
                    <p class="text-xs text-green-400 mt-2">▲ 8.5% Up from last month</p>
                </div>
                <div class="text-[#FFCC00]">
                    <!--resit icon-->
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none">
                        <path d="M6 3h12v18l-2-1-2 1-2-1-2 1-2-1-2 1V3Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9 7h6M9 11h6M9 15h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!--payroll cost-->
        <div class="rounded-2xl bg-[#3E3E3E] p-5 shadow-[0_12px_24px_rgba(0,0,0,0.18)]">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-300 text-sm">Payroll Cost</p>
                    <p class="text-white text-2xl font-bold mt-2">{{ $stats['payroll_cost'] ?? '₱0' }}</p>
                    <p class="text-xs text-gray-300 mt-3">Total approved payroll this period</p>
                    <p class="text-xs text-green-400 mt-2">▲ 1.3% Up from last month</p>
                </div>
                <div class="text-[#FFCC00]">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3a9 9 0 1 0 9 9" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 7v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M21 12V3h-9" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!--pending reqs-->
        <div class="rounded-2xl bg-[#3E3E3E] p-5 shadow-[0_12px_24px_rgba(0,0,0,0.18)]">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-300 text-sm">Pending Requests</p>
                    <p class="text-white text-2xl font-bold mt-2">{{ $stats['pending_requests'] ?? 0 }}</p>
                    <div class="text-xs text-gray-300 mt-3 space-y-1">
                        <p class="flex items-center gap-2"><span class="text-red-400">●</span> {{ $stats['expenses_count'] ?? 0 }} expenses</p>
                        <p class="flex items-center gap-2"><span class="text-gray-200">●</span> {{ $stats['payroll_entries'] ?? 0 }} payroll entries</p>
                    </div>
                </div>
                <div class="text-[#FFCC00]">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none">
                        <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!--last report gen-->
        <div class="rounded-2xl bg-[#3E3E3E] p-5 shadow-[0_12px_24px_rgba(0,0,0,0.18)]">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-300 text-sm">Last Report<br>Generated</p>
                    <p class="text-white text-xl font-bold mt-4">{{ $stats['last_report'] ?? '—' }}</p>
                </div>
                <div class="text-[#FFCC00]">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none">
                        <path d="M7 3h7l3 3v15a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M14 3v4h4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!--funds release-->
        <div class="rounded-2xl bg-[#3E3E3E] p-5 shadow-[0_12px_24px_rgba(0,0,0,0.18)]">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-gray-300 text-sm">Funds Released</p>
                    <p class="text-white text-2xl font-bold mt-2">{{ $stats['funds_released'] ?? '₱0' }}</p>
                    <p class="text-xs text-gray-300 mt-3">Total paid this period (cash + card)</p>
                </div>
                <div class="text-[#FFCC00]">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none">
                        <path d="M12 1v22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!--tabs parehas sa screen-->
    <div class="flex items-center gap-16 mb-3">
        <button class="finance-tab active font-semibold text-gray-900" onclick="switchTab(event,'payroll')">Payroll Request</button>
        <button class="finance-tab font-semibold text-gray-400" onclick="switchTab(event,'expense')">Expense Request</button>
        <button class="finance-tab font-semibold text-gray-400" onclick="switchTab(event,'manual')">Manual Record</button>
    </div>

    <!--container gaya sa screen-->
    <div class="rounded-2xl border border-gray-400/60 bg-[#ECECEC] p-4">
        <!--note lang-->
        <div class="mb-4 rounded-lg bg-gray-200 px-4 py-3 text-xs text-gray-700 flex items-center gap-2">
            <span class="text-red-500 font-bold">!</span>
            Requests marked as Complete are saved as paid and will appear in finance summary reports.
        </div>

        <!--payrol tab-->
        <div id="payrollTab">
            <div class="rounded-2xl bg-[#3E3E3E] overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="text-white">
                        <tr class="border-b border-white/10">
                            <th class="text-left px-6 py-4 font-semibold">Name</th>
                            <th class="text-left px-6 py-4 font-semibold">Files/Proof</th>
                            <th class="text-left px-6 py-4 font-semibold">Check</th>
                            <th class="text-left px-6 py-4 font-semibold">Rate</th>
                            <th class="text-left px-6 py-4 font-semibold">Date</th>
                            <th class="text-left px-6 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">
                        @forelse($payrollRequests as $request)
                            <tr class="border-b border-white/10">
                                <td class="px-6 py-5">{{ $request->name }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-white/10">
                                            <span class="text-xs font-bold text-red-400">PDF</span>
                                        </span>
                                        <span>{{ $request->file_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <a href="{{ $request->file_path ? asset($request->file_path) : '#' }}"
                                       class="text-blue-500 font-semibold hover:underline"
                                       target="_blank"
                                    >VIEW</a>
                                </td>
                                <td class="px-6 py-5 text-green-500 font-semibold">{{ $request->rate }}</td>
                                <td class="px-6 py-5">{{ optional($request->date)->format('m-d-y') }}</td>
                                <td class="px-6 py-5">
                                    <form action="{{ route('finance.payroll.complete', $request->id) }}" method="POST">
                                        @csrf
                                        <button class="inline-flex items-center gap-2 rounded bg-[#FFCC00] px-4 py-2 text-black font-semibold hover:brightness-95">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-black/10">
                                                ✓
                                            </span>
                                            Complete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-300">No payroll requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!--expens tab-->
        <div id="expenseTab" class="hidden">
            <div class="rounded-2xl bg-[#3E3E3E] overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="text-white">
                        <tr class="border-b border-white/10">
                            <th class="text-left px-6 py-4 font-semibold">Materials</th>
                            <th class="text-left px-6 py-4 font-semibold">Quantity (Stock-in)</th>
                            <th class="text-left px-6 py-4 font-semibold">Price per Unit</th>
                            <th class="text-left px-6 py-4 font-semibold">Total</th>
                            <th class="text-left px-6 py-4 font-semibold">Date</th>
                            <th class="text-left px-6 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">
                        @forelse($expenseRequests as $request)
                            <tr class="border-b border-white/10">
                                <td class="px-6 py-5">{{ $request->materials }}</td>
                                <td class="px-6 py-5">{{ $request->quantity }}</td>
                                <td class="px-6 py-5 text-gray-300">{{ $request->price_per_unit }}</td>
                                <td class="px-6 py-5 text-green-500 font-semibold">{{ $request->total }}</td>
                                <td class="px-6 py-5">{{ optional($request->date)->format('m-d-y') }}</td>
                                <td class="px-6 py-5">
                                    <form action="{{ route('finance.expense.complete', $request->id) }}" method="POST">
                                        @csrf
                                        <button class="inline-flex items-center gap-2 rounded bg-[#FFCC00] px-4 py-2 text-black font-semibold hover:brightness-95">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-black/10">
                                                ✓
                                            </span>
                                            Complete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-300">No expense requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!--manual tab-->
        <div id="manualTab" class="hidden">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xl:col-span-8">
                    <div class="rounded-2xl border border-gray-500/40 bg-[#3E3E3E] p-6">
                        <form action="{{ route('finance.manual-record.store') }}" method="POST" class="grid grid-cols-2 gap-6" id="manualForm">
                            @csrf

                            <div>
                                <label class="text-sm text-gray-200">Expense Name</label>
                                <input name="materials" required class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2" placeholder=" ">
                            </div>

                            <div>
                                <label class="text-sm text-gray-200">Date</label>
                                <input type="date" name="date" required class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2">
                            </div>

                            <div>
                                <label class="text-sm text-gray-200">Quantity (Stock-in)</label>
                                <input name="quantity" required class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2" placeholder=" ">
                            </div>

                            <div>
                                <label class="text-sm text-gray-200">Requested by</label>
                                <input name="requested_by" class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2" placeholder=" ">
                            </div>

                            <div>
                                <label class="text-sm text-gray-200">Price per unit</label>
                                <input name="price_per_unit" id="pricePerUnit" required class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2" placeholder=" ">
                            </div>

                            <div>
                                <label class="text-sm text-gray-200">Total</label>
                                <input name="total" id="totalAmount" readonly class="mt-2 w-full bg-transparent border-b border-gray-500 outline-none text-white py-2" placeholder=" ">
                            </div>

                            <div class="col-span-2 flex justify-end mt-4">
                                <button class="inline-flex items-center gap-2 rounded bg-[#FFCC00] px-8 py-3 text-black font-semibold hover:brightness-95">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-black/10">✓</span>
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-4 space-y-6">
                    <div class="rounded-2xl bg-white p-5 shadow">
                        <p class="text-sm font-semibold text-gray-900">Payroll Distribution by Project this Month</p>
                        <div class="mt-4 h-40 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
                            Chart placeholder
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow">
                        <p class="text-sm font-semibold text-gray-900">Payroll Distribution – Past Few Months</p>
                        <div class="mt-4 h-40 rounded-xl bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
                            Chart placeholder
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    
    .finance-tab { position: relative; padding-bottom: 10px; }
    .finance-tab.active { color: #111827; }
    .finance-tab.active::after{
        content:"";
        position:absolute;
        left:0; right:0; bottom:0;
        height:2px;
        background:#111827;
        border-radius:999px;
    }
</style>

<script>
    function switchTab(e, tab) {
        //buttons lang
        document.querySelectorAll('.finance-tab').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.add('text-gray-400');
        });
        e.currentTarget.classList.add('active');
        e.currentTarget.classList.remove('text-gray-400');

        //panels lang
        document.getElementById('payrollTab').classList.toggle('hidden', tab !== 'payroll');
        document.getElementById('expenseTab').classList.toggle('hidden', tab !== 'expense');
        document.getElementById('manualTab').classList.toggle('hidden', tab !== 'manual');
    }

    //manual record compute total, simple lang
    const qtyEl = document.querySelector('#manualForm input[name="quantity"]');
    const priceEl = document.getElementById('pricePerUnit');
    const totalEl = document.getElementById('totalAmount');

    function parseNumber(v){
        if(!v) return 0;
        return Number(String(v).replace(/[^\d.]/g,'') || 0);
    }

    function updateTotal(){
        const q = parseNumber(qtyEl?.value);
        const p = parseNumber(priceEl?.value);
        const total = q * p;
        totalEl.value = total ? `₱${total.toLocaleString()}` : '';
    }

    qtyEl?.addEventListener('input', updateTotal);
    priceEl?.addEventListener('input', updateTotal);
</script>
@endsection
