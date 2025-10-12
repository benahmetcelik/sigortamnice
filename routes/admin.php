<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DealerController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');


    Route::group(['prefix' => 'allowed-domains', 'as' => 'allowed-domains.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'destroy'])->name('delete');
        Route::get('/users/{id}', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'users'])->name('users');
        Route::post('/users/add', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'addUser'])->name('addUser');
        Route::post('/users/delete', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'removeUser'])->name('removeUser');
        Route::post('/theme/selectTheme', [\App\Http\Controllers\Backend\AllowedDomainController::class, 'selectTheme'])->name('selectTheme');
    });

    Route::group(['prefix' => 'domain-modules', 'as' => 'domain-modules.'], function () {
        Route::get('/{id}', [\App\Http\Controllers\Backend\DomainModuleController::class, 'index'])->name('index');
        Route::post('/addModule', [\App\Http\Controllers\Backend\DomainModuleController::class, 'addModule'])->name('addModule');
        Route::post('/updateModule', [\App\Http\Controllers\Backend\DomainModuleController::class, 'updateModule'])->name('updateModule');
        Route::get('/deleteModule/{id}', [\App\Http\Controllers\Backend\DomainModuleController::class, 'deleteModule'])->name('deleteModule');
        Route::post('/updateSettings', [\App\Http\Controllers\Backend\DomainModuleController::class, 'updateSettings'])->name('updateSettings');
    });


    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Backend\UserController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Backend\UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\UserController::class, 'destroy'])->name('delete');
    });


    Route::group(['prefix' => 'themes', 'as' => 'themes.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\ThemeController::class, 'index'])->name('index');
        Route::get('/select/{theme}', [\App\Http\Controllers\Backend\ThemeController::class, 'select'])->name('select');
        Route::get('/modules/{theme}', [\App\Http\Controllers\Backend\ThemeController::class, 'modules'])->name('modules');
        Route::get('/module/open/{uiModule}', [\App\Http\Controllers\Backend\ThemeController::class, 'moduleOpen'])->name('module.open');
        Route::get('/module/close/{uiModule}', [\App\Http\Controllers\Backend\ThemeController::class, 'moduleClose'])->name('module.close');
    });


    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\BlogController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\BlogController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\BlogController::class, 'store'])->name('store');
        Route::post('/update', [\App\Http\Controllers\Backend\BlogController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\BlogController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\BlogController::class, 'edit'])->name('edit');
    });


    Route::group(['prefix' => 'blogcategory', 'as' => 'blogcategory.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'store'])->name('store');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\BlogCategoryController::class, 'edit'])->name('edit');
    });

    Route::group(['prefix' => 'blogcomment', 'as' => 'blogcomment.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\BlogCommentController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\BlogCommentController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\BlogCommentController::class, 'store'])->name('store');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\BlogCommentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\BlogCommentController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\BlogCommentController::class, 'edit'])->name('edit');
    });


    Route::group(['prefix' => 'teklif-al', 'as' => 'teklif-al.'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\TeklifAlController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\TeklifAlController::class, 'create'])->name('create');
        Route::get('/dask', [\App\Http\Controllers\Backend\TeklifAlController::class, 'dask'])->name('dask');
        Route::post('/live-result', [\App\Http\Controllers\Backend\TeklifAlController::class, 'liveResults'])->name('live-result');
        Route::post('/dask/store', [\App\Http\Controllers\Backend\TeklifAlController::class, 'daskStore'])->name('dask.store');
        Route::get('/sonuc/{teklifId}', [\App\Http\Controllers\Backend\TeklifAlController::class, 'sonuclarCanliIzle'])->name('live.watch');
        Route::get('/trafik-sigortası', [\App\Http\Controllers\Backend\TeklifAlController::class, 'traffic'])->name('traffic');
    });

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('slider', SliderController::class);

    // Dealer Routes
    Route::resource('dealers', DealerController::class);

    // Customer Routes
    Route::resource('customers', CustomerController::class);
    Route::post('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
});
