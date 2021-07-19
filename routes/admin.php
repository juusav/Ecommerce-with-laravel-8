<?php

use App\Http\Livewire\Admin\CreateProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('products/{product}/edit', function(){
})->name('admin.products.edit');