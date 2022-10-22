<?php

use App\Http\Livewire\Authors;
use App\Http\Livewire\CashOut;
use App\Http\Livewire\CashoutGeneral;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categories;
use App\Http\Livewire\Graphics\Products as GraphicsProducts;
use App\Http\Livewire\Graphics\Sales;
use App\Http\Livewire\Graphics\Users as GraphicsUsers;
use App\Http\Livewire\Index;
use App\Http\Livewire\Index\Categories as IndexCategories;
use App\Http\Livewire\Index\Products as IndexProducts;
use App\Http\Livewire\Products;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Profile\HasPurchases;
use App\Http\Livewire\Users;
use App\Http\Livewire\Users\CartController;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     $title_page = 'Welcome';
//     return view('home',compact('title_page'))->name('home');
// });

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   Route::get('/', Index::class)->name('home');

Auth::routes();




Route::name('users.')->prefix('users')
    ->middleware('auth:sanctum')
    ->group(function() {

   
   Route::get('cart-items', CartController::class)->name('cart-items');

   Route::get('checkout', [App\Http\Controllers\SalesController::class, 'index'])
      ->name('checkout');

   Route::post('purchase-data', [App\Http\Controllers\SalesController::class, 'saveSale'])
      ->name('purchase-data');

   Route::get('crud-users', Users::class)->name('crud-users');

   Route::get('profile-settings', Profile::class)->name('profile-settings');

   Route::post('profile-update', [App\Http\Controllers\ProfileController::class, 'update'])
      ->name('profile-update');
   
   Route::post('profile-update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
      ->name('profile-update-password');

   Route::post('profile-update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
      ->name('profile-update-password');
  
   Route::get('user-historial', HasPurchases::class)->name('user-historial');

});

Route::name('products.')->prefix('products')
   ->middleware('auth:sanctum')
   ->group(function(){

   Route::get('crud-products', Products::class)->name('crud-products');

   Route::get('crud-categories', Categories::class)->name('crud-categories');

   Route::get('single-product/{id}', [App\Http\Controllers\SingleProduct::class, 'single_product'])
   ->name('single-product');

   Route::post('add-product', [App\Http\Controllers\SingleProduct::class, 'addCart'])
   ->name('add-product');
   
   Route::get('products-all', IndexProducts::class)->name('products-all');

   Route::get('product-category/{category}', IndexCategories::class)->name('product-category');

});

Route::name('reports.')->prefix('reports')
   ->middleware('auth:sanctum')
   ->group(function(){

   Route::get('users-cashout', CashOut::class)->name('users-cashout');
   // Route::get('reports', Reports::class)->name('reports');
   Route::get('general-cashout', CashoutGeneral::class)->name('general-cashout');

});

Route::name('graphics')->prefix('graphics')
   ->middleware('auth:sanctum')
   ->group(function(){

   Route::get('users-graphics-report', GraphicsUsers::class)->name('users-graphics-report');
   Route::get('products-graphics-report', GraphicsProducts::class)->name('products-graphics-report');
   Route::get('sales-graphics-report', Sales::class)->name('sales-graphics-report');


});

Route::name('sales.')
   ->middleware('auth:sanctum')
   ->group(function(){

   Route::post('payment-checkout', [App\Http\Controllers\SalesController::class, 'saveSail'])
   ->name('payment-checkout');

   Route::post('payment-see/{id}', [App\Http\Controllers\SalesController::class, 'payment_see'])
   ->name('payment-see');

   Route::get('ticket', [App\Http\Controllers\Redirect::class, 'index'])
   ->name('ticket');
   ;

});

Route::name('authors.')->prefix('authors')
   ->middleware('auth:sanctum')
   ->group(function(){

      Route::get('crud-authors', Authors::class)->name('crud-authors');

   
  ;
   // view('livewire.users.order-ticket')->name('ticket'););

});

//----- Routes for permissions -----//

// Route::get('coins', Coins::class)->name('coins');
//  Route::get('ventas', Ventas::class)->name('ventas');

// Route::get('permisos', Permisos::class)->name('permisos');
// Route::get('asignar', Asignar::class)->name('asignar');


