<?php

use App\Http\Controllers\Feedback\FeedbackController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    if (Auth::user() && (Auth::user()->role) == 'manager') {
        return redirect('/feedback');
    } elseif (Auth::user() && (Auth::user()->role) == 'client') {
        return redirect('/feedback/create');
    } else {
        return view('auth/login');
    }
})->name('dashboard');

Route::group(['middleware' => 'auth', 'namespace' => 'Feedback', 'prefix' => 'feedback'], function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('feedback.list')->middleware('is_client');
    Route::get('/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
});


//Route::get('/', [FeedbackController::class, 'index'])->middleware(['auth'])->name('feedback_list');
//
//Route::get('/', function () {
//    if ((Auth::user()->role) == 'manager') {
//        return view('feedback.list');
//    } else {
//        return view('feedback.form');
//    }
//})->middleware(['auth'])->name('dashboard');
//
//Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');

require __DIR__.'/auth.php';
