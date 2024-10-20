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

    Route::get('/profile', function () {
        echo "đã có params xxx";
    });
});

Route::prefix('users')
    ->name('users.')
    ->group(function () {
        // Route tĩnh trước
        Route::get('user-trash', [UserController::class, 'trash'])->name('trash');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');

        // Route động sau
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::delete('{user}/force-destroy', [UserController::class, 'forceDestroy'])->name('force-destroy');
        Route::post('{user}/restore', [UserController::class, 'restoreUserDestroy'])->name('restore');

        // Hiển thị danh sách người dùng
        Route::get('/', [UserController::class, 'index'])->name('index');
    });
