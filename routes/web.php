<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\FormContact;
use Illuminate\Support\Facades\Artisan;

Route::middleware('cache.headers:public;max_age=86400;etag')->group(function () {
    /* HOME */
    Route::get('/', WelcomeController::class)->name('home');
    /* CATEGORIAS Y FILTROS */
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    /* PRODUCTOS */
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    /* SERVICES */
    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    /* BUSCADOR */
    Route::get('search', SearchController::class)->name('search');
    /* CARRITO DE COMPRAS */
    Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');
    /* FORMULARIO DE CONTACTO */
    Route::get('contact', FormContact::class)->name('form-contact');
    /* NOSOTROS */
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});



Route::middleware(['auth'])->group(function(){
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/status', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.delete');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




/* FUNCIONES PARA PRODUCCION */

//RUTAS PARA LANZAR EN MODO PRODUCCION EN EL HOSTING COMPARTIDO

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache de la app eliminada';
});

 // borrar caché de ruta
 Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Cache de rutas eliminada';
});

// borrar caché de configuración
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Configuracion de cache eliminada';
}); 

// borrar caché de vista
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'Cache de vistas eliminada';
});

// optimmizar cache
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return 'Cache de vistas eliminada';
});

Route::get('storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return 'Simbolic Link establecido';
});

Route::get('modo-down', function () {
    $exitCode = Artisan::call('down --secret="consistelec2@23"');
    return 'El sistema esta en modo mantenimiento';
})->name('down');

Route::get('up', function () {
    $exitCode = Artisan::call('up');
    //return 'The system is already active';
    return back()->with('notificacion','Sistema en line');
})->name('up');

//ruta para refrescar la cache de la app
Route::get('/fresh', function() {
    $exitCode = Artisan::call('cache:clear');
    return back()->with('notificacion','System cache is up to date');
})->name('fresh');
