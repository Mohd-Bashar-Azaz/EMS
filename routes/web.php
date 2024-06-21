<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});


Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])->middleware('permission:delete role');

    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('permission:delete user');
});


Route::group(['middleware' => ['role:super-admin|admin|staff']], function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees.index');
        Route::get('/employees/create', 'create')->name('employees.create')->middleware('permission:create employee');
        Route::post('/employees', 'store')->name('employees.store');
        Route::get('/employees/{employeeId}/edit', 'edit')->name('employees.edit')->middleware('permission:edit employee');
        Route::put('/employees/{employeeId}', 'update')->name('employees.update');
        Route::delete('/employees/{employeeId}', 'destroy')->name('employees.destroy')->middleware('permission:delete employee');
    });
});



Route::group(['middleware' => ['role:super-admin']], function () {
Route::controller(SubController::class)->group(function () {
    Route::get('/datas/{employeeId}', 'index')->name('datas.index');
    Route::get('/datas/{employeeId}/create', 'create')->name('datas.create');
    Route::post('/datas', 'store')->name('datas.store');
    Route::get('/datas/{id}/edit', 'edit')->name('datas.edit');
    Route::put('/datas/{id}', 'update')->name('datas.update');
});
});


// Route::view('/roles-permissions', 'roles_permissions')->name('roles.permissions');
// Add other routes as needed

//////////////////////////////////////////////////////////////////////////////////////////////////
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
