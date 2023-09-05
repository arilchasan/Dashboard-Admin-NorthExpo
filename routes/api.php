<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WishlistController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//login-register
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::delete('/auth/delete/{id}',[UserController::class,'destroy']);
Route::get('/auth/user', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('/auth/user/block/{id}',[UserController::class,'blockUser']);    
Route::post('/auth/user/unblock/{id}',[UserController::class,'unblockUser']);    

Route::post('/auth/user/update',[UserController::class,'store'])->middleware('auth:sanctum');

Route::get('/destinasi', [DestinasiController::class, 'index']);
Route::get('/destinasi/{id}', [DestinasiController::class, 'show']);
Route::post('/destinasi', [DestinasiController::class, 'store']);
Route::post('/destinasi/{id}', [DestinasiController::class, 'update']);
Route::delete('/destinasi/{id}', [DestinasiController::class, 'destroy']);
Route::get('/destinasi', [DestinasiController::class, 'search']);

Route::get('/sisakuota/{id}/tanggal/{tanggal}', [DestinasiController::class, 'sisaKuota']);


Route::get('/email/verify/{link}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::post('email/send', [VerificationController::class, 'sendVerificationEmail'])->name('verification.send');

//kuliner
Route::get('/kuliner',[KulinerController::class,'index']);
Route::get('/kuliner/{id}',[KulinerController::class,'show']);
Route::post('/kuliner',[KulinerController::class,'store']);
Route::post('/kuliner/{id}',[KulinerController::class,'update']);
Route::delete('/kuliner/{id}',[KulinerController::class,'destroy']);

Route::post('/kuliner/komentar/{id}',[KomentarKulinerController::class,'store'])->middleware('auth:sanctum');
Route::get('/kuliner/komentar/{id}', [KulinerController::class, 'komentar']);
Route::get('/kuliner/komentar/', [KulinerController::class, 'showComment']);
Route::delete('/kuliner/komentar/{id}',[KomentarKulinerController::class,'destroy'])->middleware('auth:sanctum');

Route::post('/destinasi/komentar/{id}',[KomentarController::class,'store'])->middleware('auth:sanctum');
Route::get('/destinasi/komentar/{id}', [DestinasiController::class, 'komentar']);
Route::get('/destinasi/komentar/', [DestinasiController::class, 'showComment']);
Route::delete('/destinasi/komentar/{id}',[KomentarController::class,'destroy'])->middleware('auth:sanctum');

//payments
Route::prefix('/order')->group(function(){
    Route::get('/all', [PaymentController::class, 'all']);
    Route::get('/payment/{id}', [PaymentController::class, 'index']);
    Route::post('/transaction/{id}', [PaymentController::class, 'checkout'])->name('checkout')->middleware('auth:sanctum');
    Route::get('/get-data/{id}',[PaymentController::class, 'getDataOrder']);
    Route::get('/list', [PaymentController::class, 'list']);
    Route::get('/notifikasi/{id}', [PaymentController::class, 'notifikasi']);
    Route::get('/user/{user_id}',[PaymentController::class,'dataUser']);
});

Route::post('/callback', [PaymentController::class, 'callback'])->name('callback'); 


// Route::get('/peta',[PetaController::class,'get']);
// Route::post('/peta',[PetaController::class,'store']);
// Route::post('/peta/{id}',[PetaController::class,'update']);
// Route::delete('/peta/{id}',[PetaController::class,'destroy']);


Route::get('/wishlist/all', [WishlistController::class, 'index'])->middleware('auth:sanctum');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->middleware('auth:sanctum');

