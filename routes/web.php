<?php

use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::middleware(['ensureToken'])->group(function () {
    Route::get('/', function () {
        return view('master');
    })->name('master')->withoutMiddleware(['ensureToken']);

    Route::get('/profile',function () {
        echo "đã có params xxx";
    });
});


Route::resource('users', UserController::class);

// Route cho trang thùng rác
Route::get('user-trash', [UserController::class, 'trash'])->name('users.trash');

// Route cho việc xóa cứng
Route::delete('user-trash/{user}/force-destroy', [UserController::class, 'forceDestroy'])->name('users.forceDestroy');
