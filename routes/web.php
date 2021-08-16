<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Cartcomponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\Checkoutcomponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Shopcomponent;
use App\Http\Livewire\User\UserDashboardComponent;
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
/* 
Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/',HomeComponent::class);
Route::get('/shop',Shopcomponent::class);
Route::get('/cart',Cartcomponent::class)->name('product.cart');
Route::get('/checkout',Checkoutcomponent::class);
Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.category');


/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

//Route group for User/Customer
Route::middleware(['auth:sanctum','verified'])->group(function(){

    Route::get('/user/dasboard',UserDashboardComponent::class)->name('user.dashboard');


});
//Route group for Admin
Route::middleware(['auth:sanctum','verified'])->group(function(){

     Route::get('/admin/dasboard',AdminDashboardComponent::class)->name('admin.dashboard');
     Route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories');
     Route::get('/admin/category/add',AdminAddCategoryComponent::class)->name('admin.addcategory');
     Route::get('/admin/category/edit/{category_slug}',AdminEditCategoryComponent::class)->name('admin.editcategory');

});