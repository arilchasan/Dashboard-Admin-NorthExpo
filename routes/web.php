<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Models\Transfer;

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


Route::get('/', [HomeController::class, 'index'])->name('/')->middleware([AdminAuthMiddleware::class]);



// ----------------------------- main dashboard ------------------------------//
Route::controller(HomeController::class)->group(function () {

});
Route::middleware([AdminAuthMiddleware::class])->group(function(){
Route::prefix('dashboard')->group(function(){
    Route::get('/page', [HomeController::class, 'index'])->name('dashboard/page');
    Route::get('/laporan/{id}', [HomeController::class, 'data'])->name('dashboard/laporan');
    Route::get('/t/{id}', [HomeController::class, 'filter'])->name('filter-tanggal');
    Route::post('/laporan/tf-admin/{id}', [HomeController::class, 'filter'])->name('transfer/admin');
    Route::get('/detail/tf-admin/', [TransferController::class, 'tfAdmin']);
    Route::get('/download-excel/{id}', [HomeController::class, 'downloadExcel'])->name('downloadExcel');
    Route::get('/databulanan', [TransferController::class, 'databulanan']);
    Route::get('/scan',[TransferController::class, 'scan'])->name('scan');
    Route::post('/scanQR',[TransferController::class, 'scanQR'])->name('scanQR');
    //prefix destinasi
    Route::prefix('/destinasi')->group(function () {
        Route::get('/all', [DestinasiController::class, 'all']);
        Route::get('/detail/{id}', [DestinasiController::class, 'detail']);
        Route::get('/create', [DestinasiController::class, 'create']);
        Route::get('/edit/{id}', [DestinasiController::class, 'edit']);
        Route::post('/add', [DestinasiController::class, 'store']);
        Route::post('/update/{id}', [DestinasiController::class, 'update']);
        Route::delete('/destroy/{id}', [DestinasiController::class, 'destroy']);
        Route::get('/komentar/{id}', [DestinasiController::class, 'komentar']);
        Route::delete('/komentar/{id}', [KomentarController::class, 'destroyWeb']);
        Route::post('/sisakuota/{id}', [DestinasiController::class, 'sisakuota']);
    });

    Route::prefix('/kuliner')->group(function(){
        Route::get('/all', [KulinerController::class, 'all']);
        Route::get('create', [KulinerController::class, 'create']);
        Route::post('/add', [KulinerController::class, 'store']);
        Route::get('/detail/{id}', [KulinerController::class, 'detail']);
        Route::delete('/destroy/{id}', [KulinerController::class, 'destroy']);
        Route::get('/edit/{id}', [KulinerController::class, 'edit']);
        Route::post('/update/{id}', [KulinerController::class, 'update']);
    });

    

    Route::middleware(['web', 'auth'])->group(function () {
        Route::prefix('/wishlist')->group(function () {
            Route::get('/all', [WishlistController::class, 'index'])->middleware('auth:sanctum');
            Route::post('/add', [WishlistController::class, 'store'])->middleware('auth:sanctum');
            Route::delete('/remove', [WishlistController::class, 'destroy'])->middleware('auth:sanctum');
        }); 
    });

    //api/payment
    Route::prefix('/order')->group(function(){
        Route::get('/all', [PaymentController::class, 'all']);
        Route::get('/payment/{id}', [PaymentController::class, 'index']);
        Route::post('/transaction/{id}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::get('/list', [PaymentController::class, 'list']);
        Route::get('filter', [PaymentController::class, 'filter'])->name('dashboard.payment.filter');
        Route::get('/notifikasi/{id}', [PaymentController::class, 'notifikasi']);
        Route::get('/transaksiAdmin', [TransferController::class, 'all']);
        Route::get('/datatrs', [TransferController::class, 'datatrs'])->middleware(AdminAuthMiddleware::class);
    });
    //prefix userlogin
    Route::prefix('/userlogin')->group( function(){
        Route::get('/all', [UserController::class, 'userall']);
        Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
    });
});

});

Route::get('/email-success' ,[VerificationController::class,'emailSuccess'])->name('email-success');
Route::get('/a/{id}',[VerificationController::class,'a'])->name('a');
Auth::routes(['verify' => true]);
Route::post('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/daftar', [HomeController::class, 'register'])->name('daftar');
Route::post('/daftar/add', [AuthController::class, 'register'])->name('daftar/add');
Auth::routes(['verify' => true]);   
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/login/add', [AuthController::class, 'login'])->name('loginadd');
//login web
Route::post('/login-web', [AuthController::class, 'loginWeb'])->name('loginWeb');
//login admin
Route::post('/login-admin',[AdminController::class,'loginAdmin'])->name('loginAdmin');
Route::get('/logout-admin', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');


