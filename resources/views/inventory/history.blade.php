@extends('layouts.app')

@section('title', 'Record History')

@section('content')
<div class="page-header">
    <h1 class="page-title">Inventory Management</h1>
    <div class="search-box">
        <form method="GET" action="{{ route('inventory.history') }}" id="searchForm">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="search-icon" style="border:none;background:none;cursor:pointer;"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #000000;"></i></button>
        </form>
    </div>
</div>

<!-- tabs -->
<div class="tabs">
    <a href="{{ route('inventory.index') }}" class="tab">Overview</a>
    <a href="{{ route('inventory.stock-inout') }}" class="tab">Stock-in / Stock-out</a>
    <a href="{{ route('inventory.threshold') }}" class="tab">Set Threshold</a>
    <a href="{{ route('inventory.history') }}" class="tab active">Record History</a>
</div>

<!-- content -->
<div class="content-wrapper">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Date</th>
                    <th>Transaction Type</th>
                    <th>Quantity</th>
                    <th>Remaining Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->material->material_name }}</td>
                    <td>{{ $transaction->created_at->format('m-d-y') }}</td>
                    <td style="color: {{ $transaction->type === 'stock_in' ? '#4CAF50' : '#FF6B6B' }}; font-weight: 600;">
                        {{ $transaction->type === 'stock_in' ? 'Add Stock' : 'Use Stock' }}
                    </td>
                    <td>{{ number_format($transaction->quantity, 0) }}</td>
                    <td>{{ number_format($transaction->remaining_stock, 0) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No transaction history found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($transactions->hasPages())
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $transactions->links() }}
    </div>
    @endif
</div>
@endsection
