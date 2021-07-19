<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', function (){

})->name('admin.products.create');

Route::get('products/{product}/edit', function(){

})->name('admin.products.edit');