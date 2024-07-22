<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{id}', [TagsController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');

Route::resource('questions', QuestionsController::class);

Route::get('/catagory/{catid?}', function ($catid = null) {
    // dd($catid);
    if (!$catid) {
        $result = DB::table('products')->get();
        return view('products', ['products' => $result]);
    } else {
        $result = DB::table('products')->where('catagory_id', $catid)->get();
        return view('products', ['products' => $result]);
    }
});


Route::get('/about', [AboutController::class, 'index'])->name('about.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
