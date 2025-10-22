<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('clear-compiled');
        echo '<center> Cache cleared!!</center>';
        // return view('admin/dashboard.clear_cache');
    })->name('clear.all.cache');
Route::get('/', [WebController::class, 'index'])->name('web.index');

Route::get('/about', function () {
    return view('web.about');
})->name('web.about');

Route::get('/contact', function () {
    return view('web.contact');
})->name('web.contact');

Route::get('/add-create', [WebController::class, 'create'])->name('web.create');
Route::post('/add-create', [WebController::class, 'store'])->name('web.store');
Route::get('/add-preview/{uuid?}', [WebController::class, 'preview'])->name('web.preview');
Route::get('/add-edit/{uuid}', [WebController::class, 'edit'])->name('web.edit');
Route::put('/add-edit/{uuid}', [WebController::class, 'update'])->name('web.update');
Route::delete('/add-delete/{uuid}', [WebController::class, 'destroy'])->name('web.destroy');

Route::get('/add-listing/{category?}/{subcategory?}', [WebController::class, 'listing'])->name('web.listing');
Route::get('/add-detail/{uuid}', [WebController::class, 'detail'])->name('web.detail');
Route::get('/ad/{uuid}', [WebController::class, 'detail'])->name('web.detail.short');

// API routes for dynamic subcategories and cities
Route::get('/api/subcategories', [WebController::class, 'getSubcategories'])->name('api.subcategories');
Route::get('/api/subcategories/{category}', [WebController::class, 'getSubcategoriesByCategory'])->name('web.subcategories');
Route::get('/api/cities', [WebController::class, 'getCities'])->name('api.cities');
