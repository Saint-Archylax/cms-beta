@extends('layouts.app')

@section('title', 'Stock In/Out')

@section('content')
<!-- page header -->
<div class="page-header">
    <h1 class="page-title">Inventory Management</h1>
    <div class="search-box">
        <form method="GET" action="{{ route('inventory.stock-inout') }}" id="searchForm">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="search-icon" style="border:none;background:none;cursor:pointer;"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #000000;"></i></button>
        </form>
    </div>
</div>

<!-- tabs -->
<div class="tabs">
    <a href="{{ route('inventory.index') }}" class="tab">Overview</a>
    <a href="{{ route('inventory.stock-inout') }}" class="tab active">Stock-in / Stock-out</a>
    <a href="{{ route('inventory.threshold') }}" class="tab">Set Threshold</a>
    <a href="{{ route('inventory.history') }}" class="tab">Record History</a>
</div>

<!-- content -->
<div class="content-wrapper">
    <div class="grid-layout">
        <!-- main table -->
        <div class="table-section">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                        <tr>
                            <td>
                                <div class="material-cell">
                                    @if($material->stock <= $material->threshold)
                                        <span class="warning-icon">⚠</span>
                                    @endif
                                    <span>{{ $material->material_name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-green btn-sm" onclick="openAddStockModal({{ $material->id }}, '{{ $material->material_name }}', {{ $material->stock }}, '{{ $material->unit }}')">
                                        Stock-in
                                    </button>
                                    <button class="btn btn-red btn-sm" onclick="openUseStockModal({{ $material->id }}, '{{ $material->material_name }}', {{ $material->stock }}, '{{ $material->unit }}')">
                                        Stock-out
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- side cards -->
        <div class="side-section">
            <div class="cards-row">
                <div class="card dark-card">
                    <div class="card-icon">⚠</div>
                    <div class="card-title">Low Stock<br>Materials</div>
                    <div class="card-desc">All items that are close to running out and need replenishment.</div>
                    <button class="card-btn" onclick="showLowStock()">View</button>
                </div>

                <div class="card yellow-card">
                    <div class="card-title-small">Total Material Types</div>
                    <div class="card-number">{{ $totalMaterials }}</div>
                </div>
            </div>

            <div class="card white-card">
                <div class="card-title-small">Top Used Materials</div>
                <div class="chart-wrap">
                    <canvas id="topMaterialsChart"></canvas>
                </div>
                <div class="legend-list">
                    @foreach($topMaterials as $item)
                        <div class="legend-row">
                            <span>• {{ $item->material->material_name }}</span>
                            <span>{{ number_format($item->total, 0) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add stock modal -->
<div class="modal" id="addStockModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Add Stock</div>
            <button class="close-btn" onclick="closeModal('addStockModal')">×</button>
        </div>

        <form id="addStockForm">
            <input type="hidden" id="addMaterialId">
            <div class="form-group">
                <label class="form-label">Material</label>
                <input type="text" class="form-control" id="addMaterialName" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" id="addQuantity" step="0.01" min="0" required>
            </div>
            <button type="submit" class="btn btn-yellow" style="width: 100%;">Set</button>
        </form>
    </div>
</div>

<!-- use stock modal -->
<div class="modal" id="useStockModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Use Stock</div>
            <button class="close-btn" onclick="closeModal('useStockModal')">×</button>
        </div>

        <form id="useStockForm">
            <input type="hidden" id="useMaterialId">
            <div class="form-group">
                <label class="form-label">Material</label>
                <input type="text" class="form-control" id="useMaterialName" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" id="useQuantity" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label class="form-label">Project</label>
                <input type="text" class="form-control" id="useProject" placeholder="Optional">
            </div>
            <button type="submit" class="btn btn-yellow" style="width: 100%;">Set</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openAddStockModal(id, material_name, stock, unit) {
    $('#addMaterialId').val(id);
    $('#addMaterialName').val(material_name + ' (' + unit + ')');
    $('#addQuantity').val('');
    $('#addStockModal').addClass('active');
}

function openUseStockModal(id, material_name, stock, unit) {
    $('#useMaterialId').val(id);
    $('#useMaterialName').val(material_name + ' (' + unit + ')');
    $('#useQuantity').val('');
    $('#useProject').val('');
    $('#useStockModal').addClass('active');
}

function closeModal(modalId) {
    $('#' + modalId).removeClass('active');
}

function showLowStock() {
    $.get('{{ route("inventory.low-stock") }}', function(data) {
        if (data.length === 0) {
            alert('No low stock materials!');
            return;
        }
        const list = data.map(m => `${m.material_name}: ${m.stock} ${m.unit} (Threshold: ${m.threshold})`).join('\n');
        alert('Low Stock Materials:\n\n' + list);
    });
}

$('#addStockForm').on('submit', function(e) {
    e.preventDefault();
    
    $.post('{{ route("inventory.add-stock") }}', {
        material_id: $('#addMaterialId').val(),
        quantity: $('#addQuantity').val()
    }, function(response) {
        alert(response.message);
        location.reload();
    }).fail(function(xhr) {
        alert(xhr.responseJSON?.message || 'An error occurred');
    });
});

$('#useStockForm').on('submit', function(e) {
    e.preventDefault();
    
    $.post('{{ route("inventory.use-stock") }}', {
        material_id: $('#useMaterialId').val(),
        quantity: $('#useQuantity').val(),
        project: $('#useProject').val()
    }, function(response) {
        alert(response.message);
        location.reload();
    }).fail(function(xhr) {
        alert(xhr.responseJSON?.message || 'An error occurred');
    });
});

// chart
@if($topMaterials->count() > 0)
const ctx = document.getElementById('topMaterialsChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($topMaterials->pluck('material.material_name')) !!},
        datasets: [{
            data: {!! json_encode($topMaterials->pluck('total')) !!},
            backgroundColor: ['#000', '#6B8E23', '#87CEEB', '#9B9B9B', '#FFCC00'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
@endif

$(document).on('click', '.modal', function(e) {
    if (e.target === this) {
        $(this).removeClass('active');
    }
});
</script>
@endpush
