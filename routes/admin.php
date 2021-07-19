<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\ShowProducts;

Route::get('/', ShowProducts::class)->name('admin.index');