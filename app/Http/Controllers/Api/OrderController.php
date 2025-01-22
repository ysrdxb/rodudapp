<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderPlaced;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'status' => 'required|string|in:Pending,In Progress,Completed,Delivered',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'pickup_location' => $request->pickup_location,
            'delivery_location' => $request->delivery_location,
            'size' => $request->size,
            'weight' => $request->weight,
            'status' => $request->status,
        ]);

        $message = "New Order# {$order->id} has been created by {$order->user->name}";

        $admin = User::first();
        $admin->notify(new NewOrderPlaced($order, $message));

        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'status' => 'required|string|in:Pending,In Progress,Completed,Delivered',
        ]);

        $order->update([
            'pickup_location' => $request->pickup_location,
            'delivery_location' => $request->delivery_location,
            'size' => $request->size,
            'weight' => $request->weight,
            'status' => $request->status,
        ]);

        $message = "Order# {$order->id} has been updated by {$order->user->name}";

        $admin = User::first();
        $admin->notify(new NewOrderPlaced($order, $message));

        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();

        return response()->json(null, 204);
    }
}