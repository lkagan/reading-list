<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

// Redirect requests for home to the search page.  Will redirect guests to login.
Route::get('/', fn() => redirect(route('search')));

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/search', fn() => Inertia::render('Search'))->name('search');

    // Books
    Route::prefix('books')->name('books.')->group(function () {
        Route::post('', [BookController::class, 'store'])->name('store');
    });
});

require __DIR__.'/auth.php';
