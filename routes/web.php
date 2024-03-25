<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAuthenticationValid;
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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/guide', [MiscController::class, 'guidePage']);
Route::get('/developer', [MiscController::class, 'developerPage']);
Route::get('/logout', [UserController::class, 'logout'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/home', [UserController::class, 'home'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/data', [UserController::class, 'data'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/data/{limit}/{offset}', [UserController::class, 'data'])
    ->where(['limit' => '[0-9]+', 'offset' => '[0-9]+'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/predicts', [UserController::class, 'predicts'])
    ->middleware(EnsureAuthenticationValid::class);
Route::post('/predicts', [UserController::class, 'doPrediction'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/profile', [UserController::class, 'profile'])
    ->middleware(EnsureAuthenticationValid::class);
Route::post('/profile', [UserController::class, 'saveProfile'])
    ->middleware(EnsureAuthenticationValid::class);
Route::post('/profile/password', [UserController::class, 'savePassword'])
    ->middleware(EnsureAuthenticationValid::class);
Route::post('/profile/avatar', [UserController::class, 'saveAvatar'])
    ->middleware(EnsureAuthenticationValid::class);
Route::get('/create-symlink', function (){
    symlink(storage_path('/app/public_html'), public_path('storage'));
    echo "Symlink Created. Thanks";
});
