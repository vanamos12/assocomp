<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Admin\PaymentController;

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

Route::get('/', function(){
    return redirect()->route('login');
})->name('home');

Route::get('/category/discussion/topic', [PageController::class, 'single'])->name('single');

Route::get('discussion/create', [PageController::class, 'create'])->name('create');

Route::get('dashboard/users', [UserController::class, 'users'])->name('users');

Route::get('dashboard/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('dashboard/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('dashboard/payments/{user:username}', [PaymentController::class, 'show'])->name('payments');
Route::get('dashboard/payments/{user:username}/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('dashboard/payments/{user:username}/store', [PaymentController::class, 'store'])->name('payments.store');
Route::get('dashboard/payments/{user:username}/giveback/{payment}', [PaymentController::class, 'giveback'])->name('payments.giveback');

Route::get('/dashboard/categories/index', [PageController::class, 'categoriesIndex'])->name('categories.index');
Route::get('/dashboard/categories/create', [PageController::class, 'categoriesCreate'])->name('categories.create');

Route::get('/dashboard/threads/index', [PageController::class, 'threadsIndex'])->name('threads.index');
Route::get('/dashboard/threads/create', [PageController::class, 'threadsCreate'])->name('threads.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
