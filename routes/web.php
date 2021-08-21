<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AyarlarController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('ayarlar-genel', [AyarlarController::class, 'genel_ayarlar']);
Route::get('ayarlar-iletisim', [AyarlarController::class, 'iletisim_ayarlar']);
Route::get('ayarlar-api', [AyarlarController::class, 'api_ayarlar']);
Route::get('ayarlar-medya', [AyarlarController::class, 'medya_ayarlar']);
Route::get('ayarlar-mail', [AyarlarController::class, 'mail_ayarlar']);