<?php

use App\Http\Controllers\Admin\CategoryEventController;
use App\Http\Controllers\Admin\EvenementController;
use App\Http\Controllers\Admin\NomineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\UserController;
use App\Models\CategoryEvent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

//Admin Logout route
Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::prefix('admin')->group(function (){

    Route::get('/user/profile', [AdminController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [AdminController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');

    Route::post('/change/password/update', [AdminController::class, 'ChangePasswordUpdate'])->name('change.password.update');

});

Route::prefix('user')->group(function (){

    Route::get('/all/user', [UserController::class, 'AllUser'])->name('user.all');
    Route::get('/add/user', [AuthController::class, 'AddUser'])->name('user.add');
    Route::post('/add/user/store', [AuthController::class, 'Register'])->name('user.store');

    Route::get('/edit/{id}', [AuthController::class, 'UserEdit'])->name('user.edit');

    Route::post('/profile/update', [AuthController::class, 'UserProfileUpdate'])->name('user.profile.update');

    Route::get('/profile/delete/{id}', [AuthController::class, 'ProfileDelete'])->name('user.profile.delete');

});

Route::prefix('evenement')->group(function (){

    Route::get('/tout', [EvenementController::class, 'GetAllEvent'])->name('event.all');

    Route::get('/add', [EvenementController::class, 'AddEvent'])->name('event.add');

    Route::post('/store', [EvenementController::class, 'StoreEvent'])->name('event.store');

    Route::get('/edit/{id}', [EvenementController::class, 'EventEdit'])->name('event.edit');

    Route::post('/update', [EvenementController::class, 'EventUpdate'])->name('event.update');

    Route::get('/delete/{id}', [EvenementController::class, 'EventDelete'])->name('event.delete');

});

Route::prefix('category')->group(function (){

    Route::get('/tout', [CategoryEventController::class, 'GetAllEventCategory'])->name('category.all');

    Route::get('/add', [CategoryEventController::class, 'AddEventCategory'])->name('category.add');

    Route::post('/store', [CategoryEventController::class, 'StoreEventCategory'])->name('category.store');

    Route::get('/edit/{id}', [CategoryEventController::class, 'EventCategoryEdit'])->name('category.edit');

    Route::post('/update', [CategoryEventController::class, 'EventCategoryUpdate'])->name('category.update');

    Route::get('/delete/{id}', [CategoryEventController::class, 'EventCategoryDelete'])->name('category.delete');

});

Route::prefix('nomine')->group(function (){

    Route::get('/tout', [NomineController::class, 'GetAllNomine'])->name('nomine.all');

    Route::get('/add', [NomineController::class, 'AddNomine'])->name('nomine.add');

    Route::post('/store', [NomineController::class, 'StoreNomine'])->name('nomine.store');

    Route::get('/edit/{id}', [NomineController::class, 'NomineEdit'])->name('nomine.edit');

    Route::post('/update', [NomineController::class, 'NomineUpdate'])->name('nomine.update');

    Route::get('/delete/{id}', [NomineController::class, 'NomineDelete'])->name('nomine.delete');

});


