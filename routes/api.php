<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LineOAuthController;

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

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::get('/register/verify/{token}', [ApiController::class, 'checkRegisterEmail']);

Route::group(['middleware' => ['jwt.verify']], function () {

    // Route::group(['middleware' => ['checkemail']], function () {
    //     Route::get('get_user', [ApiController::class, 'get_user']);
    // });

    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user'])->middleware('checkemail');
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('create', [ProductController::class, 'store']);
    Route::put('update/{product}',  [ProductController::class, 'update']);
    Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
});

// LINEの認証画面に遷移
Route::get('auth/line', [LineOAuthController::class, 'redirectToProvider'])->name('line.login');
// 認証後にリダイレクトされるURL(コールバックURL)
Route::get('auth/line/callback', [LineOAuthController::class, 'handleProviderCallback']);
