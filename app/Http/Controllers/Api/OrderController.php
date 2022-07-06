<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = 2;
        $orders = Order::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return $orders;
    }
    public function show($id)
        {
            $order = Order::with(['menu'])->find($id);
            return $order;
        }
}
