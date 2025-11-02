<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\SubjectController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\TeacherController;

/*
|--------------------------------------------------------------------------
| Default route (show login if not logged in)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Backend Routes (Protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('back')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    //class
    Route::resource('classes', ClassController::class)->except(['show','create','edit']);

    //section
    Route::resource('sections', SectionController::class)->except(['show','create','edit']);

    //subject
    Route::resource('subjects', SubjectController::class)->except(['show','create','edit']);

    /////////////// Students ///////////////
    Route::resource('students', StudentController::class);

    /////////////// Teachers ///////////////
    Route::resource('teachers', TeacherController::class);


    /////////////// Roles & Permissions ///////////////
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class)->except(['create', 'show', 'edit']);
    Route::get('roles/permissions/{id}', [RoleController::class, 'addPermissionToRole'])->name('role.permissions');
    Route::put('roles/permissions/{id}', [RoleController::class, 'addPermissionToRoleUpdate'])->name('role-permissions.update');

    /////////////// Users & Profile ///////////////
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-reset', [ProfileController::class, 'reset'])->name('profile.reset');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');

    /////////////// Settings ///////////////
    Route::resource('settings', SettingController::class)->except(['show', 'edit', 'create', 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Clear Cache Routes
|--------------------------------------------------------------------------
*/
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    toast('Cache Cleared Successfully!', 'success');
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
