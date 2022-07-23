<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StatusRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Models\Address;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id === 1){
            $orders = Order::orderBy('created_at', 'desc')->paginate(10);
            return $orders;
        }
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return $orders;
    }
    public function show($id)
        {
            $order = Order::with(['menu'])->with(['user'])->find($id);
            if((Auth::user()->role_id === 1) || (Auth::user()->id === $order->user_id)){
                return $order;
            }
            return 404;
        }
    public function store(StoreRequest $request)
    {

        $address_id = $request->address_id;
        $address = Address::find($address_id);
        if ($address->user_id == Auth::user()->id) {
            $address_order = $address->city . ', ' . $address->street . ' ' . $address->house;
            if (isset($address->apartment)) {
                $address_order = $address_order . '-' . $address->apartment;
            }
            $basket = Basket::where('user_id', Auth::user()->id)->with(['menu'])->get();
            $order_price = 0;
            $pivotData = [];
            foreach ($basket as $basket_item) {
                $total_cost_item = $basket_item->quantity * $basket_item->menu->price;
                $pivotData[$basket_item->menu->id] =
                    [
                        'price' => $basket_item->menu->price,
                        'quantity'=> $basket_item->quantity,
                        'total_cost' => $total_cost_item,
                        'name' => $basket_item->menu->name,
                    ];

                $order_price += $total_cost_item;

            }
            $order = Order::create([
                'address' => $address_order,
                'phone' => Auth::user()->phone,
                'order_price' => $order_price,
                'user_id' => Auth::user()->id,
            ]);
            $order->menu()->attach($pivotData);
            $basket->each->delete();

            return $order->id;
        }

    }
    public function status(StatusRequest $request, $id)
    {
        $data = $request->validated();
        $order = Order::find($id);
        $order ->update($data);
        return 200;
    }
}
