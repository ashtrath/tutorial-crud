<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PortfolioController::class, 'index']);

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('general')->name('general.')->group(function () {
        Route::get('/', [GeneralController::class, 'index'])->name('index');
        Route::put('/info', [GeneralController::class, 'update'])->name('update-information');
        Route::put('/image', [GeneralController::class, 'updateImage'])->name('update-image');
        Route::put('/cv', [GeneralController::class, 'updateCV'])->name('update-cv');
    });

    Route::resource('skill', SkillController::class, ['except' => ['show']]);
    Route::resource('certificate', CertificateController::class, ['except' => ['show']]);
    Route::resource('project', ProjectController::class, ['except' => ['show']]);
    Route::resource('social_link', SocialLinkController::class, ['except' => ['index', 'show']]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
