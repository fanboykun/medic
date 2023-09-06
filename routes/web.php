<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\Medicine\IndexMedicine;
use App\Livewire\Medicine\AddMedicine;
use App\Livewire\User\UserProfile;
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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/medicines', IndexMedicine::class)->name('medicines.index');
    Route::get('/medicines/create', AddMedicine::class)->name('medicines.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', UserProfile::class)->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
