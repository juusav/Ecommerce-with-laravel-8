<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller{
    
    public function index(){
        return view('admin.orders.show');
    }

    public function show(Order $order){
        return view('admin.orders.show');
    }
}
