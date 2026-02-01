<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

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

    // Finance
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance/payroll/{id}/complete', [FinanceController::class, 'completePayroll'])->name('finance.payroll.complete');
    Route::post('/finance/expense/{id}/complete', [FinanceController::class, 'completeExpense'])->name('finance.expense.complete');
    Route::post('/finance/manual-record', [FinanceController::class, 'storeManualRecord'])->name('finance.manual-record.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';