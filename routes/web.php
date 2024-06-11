<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $result = DB::table('catagories')->get();
    // dd($result);
    return view('welcome', ['catagories' => $result]);
});

Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{id}', [TagsController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');

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


Route::get('/about', function () {
    return view('about');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
