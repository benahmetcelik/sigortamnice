<?php

use App\Http\Controllers\Backend\TeklifAlController;
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



Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'index'])->name('about');
Route::get('/services', [\App\Http\Controllers\HomeController::class, 'index'])->name('services');
Route::get('/pricing', [\App\Http\Controllers\HomeController::class, 'index'])->name('pricing');


Route::get('/blog', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'detail'])->name('blog.detail');

Route::get('/contact', function () {
    return view('themes.NiceTheme.contact');
})->name('contact');

Route::get('trash',[\App\Http\Controllers\Controller::class,'trash']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('slider', Backend\SliderController::class);
    Route::prefix('teklif-al')->name('teklif-al.')->group(function () {
        Route::get('/', [TeklifAlController::class, 'index'])->name('index');
        Route::get('/create', [TeklifAlController::class, 'create'])->name('create');
        Route::get('/dask', [TeklifAlController::class, 'dask'])->name('dask');
        Route::post('/dask/store', [TeklifAlController::class, 'daskStore'])->name('dask.store');
    });
});

// DASK Proxy Routes
Route::post('/dask-address-code-calculate', [App\Http\Controllers\DaskProxyController::class, 'calculateAddressCode'])->name('dask.address.code.calculate')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/dask-address-code-calculate-response', [App\Http\Controllers\DaskProxyController::class, 'calculateAddressCodeResponse'])->name('dask.address.code.calculate.response')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);



Route::get('teklif-al',function(){
   return view('themes.ThemeOne.pages.teklif-al.teklif-al');
});


Route::get('teklif-al/dask',function(){
    return view('themes.ThemeOne.pages.teklif-al.teklif-al-dask');

});


Route::get('teklif-al/dask/policelestir/{id}',[\App\Http\Controllers\Frontend\TeklifAlController::class,'policelestir'])->name('teklif.al.policelestir');


Route::post('dask-store',[\App\Http\Controllers\Frontend\TeklifAlController::class,'daskStore'])->name('dask.store');
Route::get('dask-teklifleri-incele/{teklifId}',[\App\Http\Controllers\Frontend\TeklifAlController::class,'sonuclarCanliIzle'])->name('dask.teklifler.incele');
