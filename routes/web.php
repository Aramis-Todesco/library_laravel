<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LoanController;
use App\Http\Middleware\protectedArea;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/books/search_book',[BookController::class,'search'])->name('books.search');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/update/{id}', [BookController::class, 'update'])->name('books.update');

    Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])->name('books.delete')
        ->middleware(protectedArea::class);

    Route::get('/home', function () {
        return view('home');
    });

    Route::resource('copies',CopyController::class);
    Route::get('/books/create_from_book/{id}', [CopyController::class, 'create_from_book'])->name('books.create_from_book');


    Route::get('/loans',[LoanController::class,'index'])->name('loans.index');
    Route::get('/loans/create/{copy_id}',[LoanController::class,'create'])->name('loans.create');
    Route::get('/loans/show/{copy_id}',[LoanController::class,'show'])->name('loans.show');
    Route::post('/loans/store',[LoanController::class,'store'])->name('loans.store');
    Route::post('/loans/end_loan',[LoanController::class,'end_loan'])->name('loans.end_loan');
    Route::post('/loans/extension_loan',[LoanController::class,'extension_loan'])->name('loans.extension_loan');

    
});
