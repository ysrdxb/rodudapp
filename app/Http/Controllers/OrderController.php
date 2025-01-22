<?php

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required|string',
            'delivery_location' => 'required|string',
            'size' => 'required|string',
            'weight' => 'required|numeric',
            'pickup_time' => 'required|date',
            'delivery_time' => 'required|date|after:pickup_time',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'pickup_location' => $request->pickup_location,
            'delivery_location' => $request->delivery_location,
            'size' => $request->size,
            'weight' => $request->weight,
            'pickup_time' => $request->pickup_time,
            'delivery_time' => $request->delivery_time,
            'status' => 'pending',
        ]);

        $admin = User::where('role', 'admin')->first();
        $admin?->notify(new NewOrderPlaced($order));

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    public function index()
    {
        $orders = auth()->user()->orders;
        return response()->json(['orders' => $orders]);
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        return response()->json(['order' => $order]);
    }
}