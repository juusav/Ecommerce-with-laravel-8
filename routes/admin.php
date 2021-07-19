<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/{product}/edit', function(){

})->name('admin.products.edit');