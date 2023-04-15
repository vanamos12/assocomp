<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CotisationController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard/users', [UserController::class, 'users'])->name('users');

    Route::get('dashboard/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('dashboard/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('dashboard/users/{user:username}/show', [UserController::class, 'show'])->name('users.show');
    
    Route::get('dashboard/payments/{user:username}', [PaymentController::class, 'show'])->name('payments');
    Route::get('dashboard/payments/{user:username}/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('dashboard/payments/{user:username}/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('dashboard/payments/{user:username}/giveback/{payment}', [PaymentController::class, 'giveback'])->name('payments.giveback');
    
    Route::get('dashboard/meetings', [MeetingController::class, 'list'])->name('meetings');
    Route::get('dashboard/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('dashboard/meetings/store', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('dashboard/meetings/{meeting}', [MeetingController::class, 'show'])->name('meetings.show');
    Route::get('dashboard/meetings/{meeting}/loan/create', [MeetingController::class, 'loanCreate'])->name('meetings.loan.create');
    Route::post('dashboard/meetings/{meeting}/loan/store', [MeetingController::class, 'loanStore'])->name('meetings.loan.store');
    Route::get('dashboard/meetings/{meeting}/borrow/create', [MeetingController::class, 'borrowCreate'])->name('meetings.borrow.create');
    Route::post('dashboard/meetings/{meeting}/borrow/store', [MeetingController::class, 'borrowStore'])->name('meetings.borrow.store');
    Route::get('dashboard/meetings/{meeting}/cotiser/create', [MeetingController::class, 'cotiserCreate'])->name('meetings.cotiser.create');
    Route::post('dashboard/meetings/{meeting}/cotiser/store', [MeetingController::class, 'cotiserStore'])->name('meetings.cotiser.store');
    
    
    Route::get('dashboard/rubriques', [CotisationController::class, 'rubriqueList'])->name('rubriques');
    Route::get('dashboard/rubriques/create', [CotisationController::class, 'rubriqueCreate'])->name('rubriques.create');
    Route::post('dashboard/rubriques/store', [CotisationController::class, 'rubriqueStore'])->name('rubriques.store');
    Route::get('dashboard/rubriques/edit/{rubrique}', [CotisationController::class, 'rubriqueEdit'])->name('rubriques.edit');
    Route::post('dashboard/rubriques/store/{rubrique}', [CotisationController::class, 'rubriqueEditStore'])->name('rubriques.editStore');

    Route::get('dashboard/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('dashboard/companies/store', [CompanyController::class, 'store'])->name('companies.store');
    
});


Route::get('/category/discussion/topic', [PageController::class, 'single'])->name('single');

Route::get('discussion/create', [PageController::class, 'create'])->name('create');


Route::get('/dashboard/categories/index', [PageController::class, 'categoriesIndex'])->name('categories.index');
Route::get('/dashboard/categories/create', [PageController::class, 'categoriesCreate'])->name('categories.create');

Route::get('/dashboard/threads/index', [PageController::class, 'threadsIndex'])->name('threads.index');
Route::get('/dashboard/threads/create', [PageController::class, 'threadsCreate'])->name('threads.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->name('admin-dashboard');
