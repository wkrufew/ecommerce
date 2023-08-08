<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\CaracteristicComponent;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CityComponent;
use App\Http\Livewire\Admin\CreateService;
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\EditService;
use App\Http\Livewire\Admin\SettingCompany;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\ShowService;
use App\Http\Livewire\Admin\UserComponent;
use Illuminate\Support\Facades\Route;

/* PRODUCTOS */
Route::get('/', ShowProducts::class)->name('admin.index');
Route::get('products/create', CreateProduct::class)->name('admin.products.create');
Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::get('products/{product}/caracteristics', CaracteristicComponent::class)->name('admin.products.caracteristic');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');
/* CATEGORIAS */
Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');
/* MARCAS */
Route::get('brands', BrandComponent::class)->name('admin.brands.index');
/* ORDENES */
Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
/* DIRECCIONES */
Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');
Route::get('cities/{city}', CityComponent::class)->name('admin.cities.show');
/* Route::get('users', UserComponent::class)->name('admin.users.index'); */
/* SLIDER */
Route::get('/sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
Route::get('sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
Route::post('sliders', [SliderController::class,'store'])->name('admin.sliders.store');
Route::get('sliders/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
Route::put('sliders/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
/* SETTINGS */
Route::get('settings', SettingCompany::class)->name('admin.settings.index');
/* SERVICES */
Route::get('/services', ShowService::class)->name('admin.services.index');
Route::get('services/create', CreateService::class)->name('admin.services.create');
Route::get('services/{service}/edit', EditService::class)->name('admin.services.edit');
Route::post('services/{service}/files', [ServiceController::class, 'files'])->name('admin.services.files');
/* USUARIOS */
Route::get('users', UserComponent::class)->name('admin.users.index');
/* DASHBOARD */
Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');