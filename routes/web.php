<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrController;
use App\Models\Document;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| QR: Upload daftar, upload biasa, upload+EMBED, detail, unduhan
|--------------------------------------------------------------------------
*/
Route::prefix('qr')->name('qr.')->group(function () {
    Route::get('/uploads', [QrController::class, 'index'])->name('index');
    Route::get('/pdf-upload', [QrController::class, 'create'])->name('pdf.create');
    Route::post('/pdf-upload', [QrController::class, 'store'])->name('pdf.store');
    Route::post('/pdf-upload-embed', [QrController::class, 'storeAndEmbed'])->name('store.embed');
    Route::get('/{uuid}', [QrController::class, 'show'])->name('show');
    Route::get('/{uuid}/download-qr', [QrController::class, 'downloadQr'])->name('download.qr');
    Route::get('/{uuid}/download-pdf', [QrController::class, 'downloadPdf'])->name('download.pdf');

    // Hapus (pakai nama: qr.delete) — mengikuti prefix/name group
    Route::delete('/{uuid}', [QrController::class, 'delete'])->name('delete');
});

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/settings',  [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.role');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.delete');
});

/*
|--------------------------------------------------------------------------
| PUBLIC: VERIFY
|--------------------------------------------------------------------------
*/
Route::prefix('verify')->name('verify.')->group(function () {
    Route::get('/',       [VerifyController::class, 'index'])->name('index');
    Route::get('/{uuid}', [VerifyController::class, 'show'])->name('show');
});


/*
|--------------------------------------------------------------------------
| PROTECTED: Dashboard, Documents, QR Generator, Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('dashboard', ['title' => 'Dashboard']))
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    // Download PDF asli per UUID
    Route::get('/documents/{uuid}/download', [VerifyController::class, 'download'])
        ->name('documents.download');

    // QR generator (opsional)
    Route::get('/qr-generator', fn () => view('QR.generator-index'))->name('qr.index');
    Route::get('/qr-generator/{document}', function (Document $document) {
        return view('QR.generator', ['doc' => $document]);
    })->name('qr.show');

    // Tambahan untuk dokumen
    Route::post('/documents/{document}/render', [DocController::class, 'render'])
        ->name('documents.render');
    Route::post('/documents/{document}/render-download-qr', [DocController::class, 'renderAndDownloadQr'])
        ->name('documents.renderDownloadQr');

    // resource utama
    Route::resource('documents', DocController::class)
        ->parameters(['documents' => 'document']);


Route::middleware(['auth', AdminMiddleware::class])
    ->get('/admin', [AdminController::class, 'index']);

// DASHBOARD ADMIN
Route::middleware(['auth', AdminMiddleware::class])
    ->get('/admin', [AdminController::class, 'index']);


});

