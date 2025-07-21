<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Complaint\ComplaintController;
use App\Models\Complaint;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsNoc;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Noc\NocDashboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleRedirectMiddleware;


// root
Route::get('/', function () {
    return view('welcome');
});

//user(pengguna)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role.redirect'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//complaints
Route::middleware(['auth'])->group(function () {
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show');

});

//admin
Route::middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/complaints/{id}', [AdminDashboardController::class, 'show'])->name('admin.complaints.show');
    Route::post('/admin/complaints/{id}/assign', [AdminDashboardController::class, 'assign'])->name('admin.complaints.assign');
     Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');

    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}', [UserManagementController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');   
});


//NOC
Route::middleware(['auth', IsNoc::class])->group(function(){
    Route::get('/noc', [NocDashboardController::class, 'index'])->name('noc.dashboard');
    Route::get('/noc/complaints/{id}', [NocDashboardController::class, 'show'])->name('noc.complaints.show');
    Route::put('/noc/complaints/{id}/status', [NocDashboardController::class, 'updateStatus'])->name('noc.complaints.updateStatus');
});


require __DIR__.'/auth.php';
