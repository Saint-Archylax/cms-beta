@extends('layouts.app')

@section('title', 'Set Threshold')

@section('content')
<div class="page-header">
    <h1 class="page-title">Inventory Management</h1>
    <div class="search-box">
        <form method="GET" action="{{ route('inventory.threshold') }}" id="searchForm">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="search-icon" style="border:none;background:none;cursor:pointer;"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #000000;"></i></button>
        </form>
    </div>
</div>

<!-- tabs -->
<div class="tabs">
    <a href="{{ route('inventory.index') }}" class="tab">Overview</a>
    <a href="{{ route('inventory.stock-inout') }}" class="tab">Stock-in / Stock-out</a>
    <a href="{{ route('inventory.threshold') }}" class="tab active">Set Threshold</a>
    <a href="{{ route('inventory.history') }}" class="tab">Record History</a>
</div>

<!-- content -->
<div class="content-wrapper">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Supplier</th>
                    <th>Current Threshold</th>
                    <th>Set Threshold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $material)
                <tr>
                    <td>{{ $material->material_name }}</td>
                    <td>{{ $material->supplier }}</td>
                    <td>{{ number_format($material->threshold, 0) }} {{ $material->unit }}</td>
                    <td>
                        <button class="btn btn-yellow btn-sm" onclick="openThresholdModal({{ $material->id }}, '{{ $material->material_name }}', {{ $material->threshold }}, '{{ $material->unit }}')">
                            Set <i class="fa-regular fa-pen-to-square fa-sm"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- set threshold modal -->
<div class="modal" id="thresholdModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <div class="logo" style="width: 30px; height: 30px; font-size: 8px;">LM</div>
            </div>
            <div class="modal-title">Set threshold</div>
            <button class="close-btn" onclick="closeModal('thresholdModal')">×</button>
        </div>
        <div class="modal-subtitle">Minimum and Maximum</div>
        <form id="thresholdForm">
            <input type="hidden" id="thresholdMaterialId">
            <div class="form-group">
                <label class="form-label">Material</label>
                <input type="text" class="form-control" id="thresholdMaterialName" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Minimum Supply</label>
                <input type="number" class="form-control" id="minThreshold" placeholder="Lowest" step="0.01" min="0" required>
            </div>
            <button type="submit" class="btn btn-yellow" style="width: 100%;">Set</button>
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #444; text-align: center;">
                <div style="color: #888; font-size: 12px; margin-bottom: 10px;">
                    Encountered any problems? Click here<br>Or report via email or facebook
                </div>
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <a href="#" style="width: 32px; height: 32px; background: #444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none;">✉</a>
                    <a href="#" style="width: 32px; height: 32px; background: #444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none;">f</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openThresholdModal(id, material_name, threshold, unit) {
    $('#thresholdMaterialId').val(id);
    $('#thresholdMaterialName').val(material_name + ' (' + unit + ')');
    $('#minThreshold').val(threshold);
    $('#thresholdModal').addClass('active');
}

function closeModal(modalId) {
    $('#' + modalId).removeClass('active');
}

$('#thresholdForm').on('submit', function(e) {
    e.preventDefault();
    
    $.post('{{ route("inventory.update-threshold") }}', {
        material_id: $('#thresholdMaterialId').val(),
        threshold: $('#minThreshold').val()
    }, function(response) {
        alert(response.message);
        location.reload();
    }).fail(function(xhr) {
        alert(xhr.responseJSON?.message || 'An error occurred');
    });
});

$(document).on('click', '.modal', function(e) {
    if (e.target === this) {
        $(this).removeClass('active');
    }
});
</script>
@endpush
