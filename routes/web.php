<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponsComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponsComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeCouponsComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Cartcomponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\Checkoutcomponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Shopcomponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\WishListComponent;
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
Route::get('/wishlist',WishListComponent::class)->name('product.wishlist');


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
     Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
     Route::get('/admin/product/add',AdminAddProductComponent::class)->name('admin.addproduct');
     Route::get('/admin/product/edit/{product_id}',AdminEditProductComponent::class)->name('admin.editproduct');
   Route::get('/admin/sliders',AdminHomeSliderComponent::class)->name('admin.sliders');
   Route::get('/admin/sliders/add',AdminAddHomeSliderComponent::class)->name('admin.addslider');
   Route::get('/admin/sliders/edit/{slider_id}',AdminEditHomeSliderComponent::class)->name('admin.editslider');
   Route::get('/admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');
   Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sales');

   Route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
   Route::get('/admin/coupons/add',AdminAddCouponsComponent::class)->name('admin.addcoupons');
   Route::get('/admin/coupons/edit/{coupon_id}',AdminEditCouponsComponent::class)->name('admin.editcoupons');


});