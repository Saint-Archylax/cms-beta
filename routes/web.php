<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::middleware(['auth'])->group(function () {

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Team
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/documents', [TeamController::class, 'documents'])->name('team.documents');
    Route::get('/team/payroll', [TeamController::class, 'payroll'])->name('team.payroll');
    Route::get('/team/assign', [TeamController::class, 'assign'])->name('team.assign');
    Route::get('/team/attendance', [TeamController::class, 'attendance'])->name('team.attendance');
    Route::post('/team/attendance/{id}/approve', [TeamController::class, 'approveAttendance'])->name('team.attendance.approve');
    Route::post('/team/attendance/{id}/reject', [TeamController::class, 'rejectAttendance'])->name('team.attendance.reject');
    Route::post('/team/projects/{projectId}/assign', [TeamController::class, 'assignToProject'])->name('team.assign-to-project');
    Route::post('/team/update-requests/{id}/approve', [TeamController::class, 'approveUpdateRequest'])->name('team.update-requests.approve');
    Route::post('/team/update-requests/{id}/reject', [TeamController::class, 'rejectUpdateRequest'])->name('team.update-requests.reject');
    Route::get('/team/members/list', [TeamController::class, 'listMembers'])->name('team.members.list');

    // Finance
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance/payroll/{id}/complete', [FinanceController::class, 'completePayroll'])->name('finance.payroll.complete');
    Route::post('/finance/expense/{id}/complete', [FinanceController::class, 'completeExpense'])->name('finance.expense.complete');
    Route::post('/finance/manual-record', [FinanceController::class, 'storeManualRecord'])->name('finance.manual-record.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory (IMS)
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        Route::get('/stock-inout', [InventoryController::class, 'stockInOut'])->name('stock-inout');
        Route::get('/threshold', [InventoryController::class, 'threshold'])->name('threshold');
        Route::get('/history', [InventoryController::class, 'history'])->name('history');

        Route::post('/add-stock', [InventoryController::class, 'addStock'])->name('add-stock');
        Route::post('/use-stock', [InventoryController::class, 'useStock'])->name('use-stock');
        Route::post('/update-threshold', [InventoryController::class, 'updateThreshold'])->name('update-threshold');
    });

    // Materials (MMS)
    Route::prefix('materials')->name('materials.')->group(function () {
        Route::get('/', [MaterialController::class, 'overview'])->name('overview');

        // create flow
        Route::get('/create', [MaterialController::class, 'chooseSupplier'])->name('create');
        Route::get('/supplier/{supplier}', [MaterialController::class, 'supplierProducts'])->name('supplier.products');

        //cart (session)
        Route::post('/cart/add', [MaterialController::class, 'cartAdd'])->name('cart.add');
        Route::post('/cart/remove', [MaterialController::class, 'cartRemove'])->name('cart.remove');
        Route::get('/cart', [MaterialController::class, 'cartView'])->name('cart.view');
        Route::post('/cart/checkout', [MaterialController::class, 'cartCheckout'])->name('cart.checkout');

        //crud actions on existing materials
        Route::post('/{material}/update', [MaterialController::class, 'update'])->name('update');
        Route::post('/{material}/delete', [MaterialController::class, 'delete'])->name('delete');

        //history
        Route::get('/history', [MaterialController::class, 'history'])->name('history');
    });

});

require __DIR__ . '/auth.php';
