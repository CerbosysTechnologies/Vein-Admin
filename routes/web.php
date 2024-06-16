<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LaboratoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\FranchiseController;

// use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';




Route::get('/auth/google', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleGoogleCallback']);
// Admin

Route::middleware('guest:admin')->group(function () {
    // Login route
    Route::get('/', '\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@create')->name('admin.login');
    // Admin login route
    Route::post('admin/login', '\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@store')->name('admin.adminlogin');
    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])->name('admin.password.request');
    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])->name('admin.password.email');
    Route::get('admin/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('admin/reset-password', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
});

// Logout route
Route::post('logout', '\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController@destroy')->name('logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/api/search', [AdminController::class, 'search']);

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('package', PackageController::class);
    Route::resource('test', TestController::class);
    Route::resource('slot', SlotController::class);
    Route::resource('user', UserController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('laboratory_location', LaboratoryController::class);
    Route::get('appointment/lab', [AppointmentController::class, 'getLabAppointment'])->name('lab.index');
    Route::get('appointment/home', [AppointmentController::class, 'getHomeAppointment'])->name('home.index');
    Route::put('admin/slot/{slotId}', [SlotController::class, 'updateStatus'])->name('slot.update');

    Route::get('franchise', [FranchiseController::class, 'index'])->name('franchise.index');



    // Route for viewing the profile
    Route::resource('myprofile', AdminController::class);
});
