<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StatusRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Models\Address;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::where('user_id', Auth::user()->id)->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function dashboard()
    {
        $orders = Order::paginate(10);
        return(view('orders.dashboard',['orders'=>$orders]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
            foreach ($basket as $basket_item) {
                $order_price += $basket_item->quantity * $basket_item->menu->price;
            }
            $order = Order::create([
                'address' => $address_order,
                'phone' => Auth::user()->phone,
                'order_price' => $order_price,
                'user_id' => Auth::user()->id,
            ]);


        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function status(StatusRequest $request, $id)
    {
        $data = $request->validated();
        $order = Order::find($id);
        $order ->update($data);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
