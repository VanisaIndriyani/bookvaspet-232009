<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Wajib: Untuk login ulang
use Illuminate\Support\Facades\URL; // Untuk validasi signed URL
use App\Models\User; // Wajib: Untuk mencari user berdasarkan ID
use Illuminate\Auth\Events\Verified; // Event untuk verifikasi email

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AnimalController as AdminAnimalController;
use App\Http\Controllers\Admin\VaccinationController as AdminVaccinationController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\VeterinarianController as AdminVeterinarianController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Route yang dapat diakses oleh pengguna yang belum login.
*/
Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Email Verification Route (Dapat diakses tanpa login)
|--------------------------------------------------------------------------
| Route ini dapat diakses oleh guest karena link verifikasi dikirim via email
| dan pengguna mungkin belum login saat mengklik link tersebut.
*/
// Route untuk memproses tautan verifikasi email (TIDAK memerlukan auth)
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    
    // 1. Validasi signed URL (memastikan link tidak dimanipulasi)
    if (! URL::hasValidSignature($request)) {
        abort(403, 'Link verifikasi tidak valid atau sudah kedaluwarsa.');
    }

    // 2. Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // 3. Validasi hash email (memastikan email tidak berubah)
    if (! hash_equals((string) $hash, sha1($user->email))) {
        abort(403, 'Link verifikasi tidak valid.');
    }

    // 4. Cek jika email sudah terverifikasi sebelumnya
    if ($user->hasVerifiedEmail()) {
        // Jika sudah terverifikasi, langsung login dan redirect berdasarkan role (Admin = Dokter Hewan)
        Auth::login($user);
        $dashboardRoute = 'dashboard';
        if ($user->role === 'dokter_hewan') {
            $dashboardRoute = 'admin.dashboard';
        }
        return redirect()->route($dashboardRoute)->with('status', 'Email Anda sudah terverifikasi sebelumnya. Anda telah masuk.');
    }
    
    // 5. Lakukan verifikasi email
    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }

    // 6. Login pengguna setelah verifikasi berhasil
    Auth::login($user);
    
    // 7. Redirect ke dashboard berdasarkan role (Admin = Dokter Hewan)
    $dashboardRoute = 'dashboard';
    if ($user->role === 'dokter_hewan') {
        $dashboardRoute = 'admin.dashboard';
    }
    
    return redirect()->route($dashboardRoute)->with('status', 'Email Anda berhasil diverifikasi! Anda telah masuk.');

})->middleware(['signed'])->name('verification.verify');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| Route yang hanya dapat diakses oleh pengguna yang sudah login.
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    /*
    |----------------------------------------------------------------------
    | Email Verification Routes (Halaman notifikasi)
    |----------------------------------------------------------------------
    */

    // Halaman pemberitahuan verifikasi (jika belum verified)
    Route::get('/email/verify', function () {

        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    // Route untuk mengirim ulang notifikasi verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Tautan verifikasi baru telah dikirim ke alamat email Anda.');
    })->middleware(['throttle:6,1'])->name('verification.send');
    
    // Route Dashboard Pengguna
    Route::get('/dashboard', UserDashboardController::class)
        ->middleware('verified')
        ->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | Admin Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['verified', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Manajemen User
        Route::resource('users', AdminUserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
        
        // Data Hewan
        Route::resource('animals', AdminAnimalController::class)->names([
            'index' => 'admin.animals.index',
            'create' => 'admin.animals.create',
            'store' => 'admin.animals.store',
            'edit' => 'admin.animals.edit',
            'update' => 'admin.animals.update',
            'destroy' => 'admin.animals.destroy',
        ]);
        
        // Riwayat Vaksin
        Route::resource('vaccinations', AdminVaccinationController::class)->names([
            'index' => 'admin.vaccinations.index',
            'create' => 'admin.vaccinations.create',
            'store' => 'admin.vaccinations.store',
            'edit' => 'admin.vaccinations.edit',
            'update' => 'admin.vaccinations.update',
            'destroy' => 'admin.vaccinations.destroy',
        ]);

        // Data Mata Kuliah
        Route::resource('courses', AdminCourseController::class)->names([
            'index' => 'admin.courses.index',
            'create' => 'admin.courses.create',
            'store' => 'admin.courses.store',
            'edit' => 'admin.courses.edit',
            'update' => 'admin.courses.update',
            'destroy' => 'admin.courses.destroy',
        ])->except(['show']);

        // Data Buku
        Route::resource('books', AdminBookController::class)->names([
            'index' => 'admin.books.index',
            'create' => 'admin.books.create',
            'store' => 'admin.books.store',
            'edit' => 'admin.books.edit',
            'update' => 'admin.books.update',
            'destroy' => 'admin.books.destroy',
        ])->except(['show']);

        // Data Barang
        Route::resource('barangs', AdminBarangController::class)->names([
            'index' => 'admin.barangs.index',
            'create' => 'admin.barangs.create',
            'store' => 'admin.barangs.store',
            'edit' => 'admin.barangs.edit',
            'update' => 'admin.barangs.update',
            'destroy' => 'admin.barangs.destroy',
        ])->except(['show']);
        
        // Laporan & Statistik
        Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
        
        // Transaksi Pembayaran
        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
        Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('admin.transactions.show');
        Route::post('/transactions/{id}/set-amount', [AdminTransactionController::class, 'setAmount'])->name('admin.transactions.set-amount');
        Route::post('/transactions/{id}/verify', [AdminTransactionController::class, 'verifyPayment'])->name('admin.transactions.verify');
        Route::get('/transactions/{id}/download-proof', [AdminTransactionController::class, 'downloadProof'])->name('admin.transactions.download-proof');
        
        // Pengaturan
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings/email', [AdminSettingController::class, 'updateEmail'])->name('admin.settings.update-email');
        Route::put('/settings/password', [AdminSettingController::class, 'updatePassword'])->name('admin.settings.update-password');
    });

    /*
    |----------------------------------------------------------------------
    | User Routes (Untuk User Biasa)
    |----------------------------------------------------------------------
    */
    Route::middleware('verified')->group(function () {
        // Riwayat Vaksinasi User
        Route::get('/vaccinations', [VaccinationController::class, 'index'])->name('vaccinations.index');
        
        // Transaksi Pembayaran User
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::post('/transactions/{id}/upload-proof', [TransactionController::class, 'uploadProof'])->name('transactions.upload-proof');
    });
});

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});