<?php

namespace App\Http\Controllers;

use App\Models\PayrollRequest;
use App\Models\ExpenseRequest;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $stats = $this->getFinanceStats();
        $payrollRequests = PayrollRequest::where('status', 'pending')->get();
        $expenseRequests = ExpenseRequest::where('status', 'pending')->get();
        
        return view('finance.index', compact('stats', 'payrollRequests', 'expenseRequests'));
    }

    private function getFinanceStats()
    {
        $totalExpenses = ExpenseRequest::where('status', 'complete')
            ->get()
            ->sum(function($request) {
                return (float) str_replace(['₱', ','], '', $request->total);
            });

        $payrollCost = PayrollRequest::where('status', 'complete')
            ->get()
            ->sum(function($request) {
                return (float) str_replace(['₱', ','], '', $request->rate);
            });

        $pendingRequests = PayrollRequest::where('status', 'pending')->count() + 
                          ExpenseRequest::where('status', 'pending')->count();

        return [
            'total_expenses' => '₱' . number_format($totalExpenses, 2),
            'payroll_cost' => '₱' . number_format($payrollCost, 2),
            'pending_requests' => $pendingRequests,
            'last_report' => 'Sept 09, 2025',
            'funds_released' => '₱1,200,000',
            'expenses_count' => ExpenseRequest::where('status', 'pending')->count(),
            'payroll_entries' => PayrollRequest::where('status', 'pending')->count(),
        ];
    }

    public function completePayroll($id)
    {
        $payroll = PayrollRequest::findOrFail($id);
        $payroll->update(['status' => 'complete']);
        
        return redirect()->back()->with('success', 'Payroll request completed');
    }

    public function completeExpense($id)
    {
        $expense = ExpenseRequest::findOrFail($id);
        $expense->update(['status' => 'complete']);
        
        return redirect()->back()->with('success', 'Expense request completed');
    }

    public function storeManualRecord(Request $request)
    {
        $validated = $request->validate([
            'materials' => 'required|string',
            'date' => 'required|date',
            'quantity' => 'required|string',
            'requested_by' => 'required|string',
            'price_per_unit' => 'required|string',
            'total' => 'required|string',
        ]);

        $validated['status'] = 'complete';

        ExpenseRequest::create($validated);
        
        return redirect()->back()->with('success', 'Manual record saved');
    }
}