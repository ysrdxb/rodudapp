<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Notifications\NewOrderPlaced;
use App\Events\NewOrderPlacedEvent;
use App\Services\NotificationService;

class OrderManagement extends Component
{
    protected $notificationService;
    public $orders = [];
    public $createForm = false;
    public $order_id, $pickup_location, $delivery_location, $size, $weight, $status;
    public $search = '';

    protected $rules = [
        'pickup_location' => 'required|string|max:255',
        'delivery_location' => 'required|string|max:255',
        'size' => 'required|numeric|min:0',
        'weight' => 'required|numeric|min:0',
        'status' => 'required|in:Pending,In Progress,Delivered',
    ];   

    public function mount()
    {
        $this->fetchOrders();      
    }

    public function fetchOrders()
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->get(config('app.url') . '/api/orders');

            if ($response->successful()) {
                $this->orders = collect($response->json());
            } else {
                $this->orders = [];
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while fetching orders: ' . $e->getMessage());
        }
    }    

    public function createOrder()
    {
        $this->validate();

        try {
            $token = session('api_token');
            $response = Http::withToken($token)->post(config('app.url') . '/api/orders', [
                'pickup_location' => $this->pickup_location,
                'delivery_location' => $this->delivery_location,
                'size' => $this->size,
                'weight' => $this->weight,
                'status' => $this->status,
            ]);

            if ($response->successful()) {
                $this->resetForm();
                $this->fetchOrders();
                $this->createForm = false;
                session()->flash('success', 'Order created successfully.');
            } else {
                throw ValidationException::withMessages(['error' => 'Failed to create order.']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while creating the order.');
        }
    }

    public function editOrder($order_id)
    {
        $order = $this->orders->firstWhere('id', $order_id);

        if ($order) {
            $this->order_id = $order['id'];
            $this->pickup_location = $order['pickup_location'];
            $this->delivery_location = $order['delivery_location'];
            $this->size = $order['size'];
            $this->weight = $order['weight'];
            $this->status = $order['status'];
            $this->createForm = true;
        }
    }

    public function updateOrder()
    {
        $this->validate();

        try {
            $token = session('api_token');
            $response = Http::withToken($token)->put(config('app.url') . '/api/orders/' . $this->order_id, [
                'pickup_location' => $this->pickup_location,
                'delivery_location' => $this->delivery_location,
                'size' => $this->size,
                'weight' => $this->weight,
                'status' => $this->status,
            ]);

            if ($response->successful()) {
                $this->resetForm();
                $this->fetchOrders();
                $this->createForm = false;
                session()->flash('success', 'Order updated successfully.');
            } else {
                session()->flash('error', 'Failed to update order.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the order.');
        }
    }

    public function deleteOrder($order_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->delete(config('app.url') . '/api/orders/' . $order_id);

            if ($response->successful()) {
                $this->fetchOrders();
                session()->flash('success', 'Order deleted successfully.');
            } else {
                session()->flash('error', 'Failed to delete order.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the order.');
        }
    }

    public function resetForm()
    {
        $this->order_id = null;
        $this->pickup_location = '';
        $this->delivery_location = '';
        $this->size = '';
        $this->weight = '';
        $this->status = 'Pending';
    }

    public function render()
    {
        return view('livewire.user.order-management', [
            'orders' => collect($this->orders ?? [])->filter(function ($order) {
                return str_contains(strtolower($order['pickup_location'] ?? ''), strtolower($this->search)) ||
                       str_contains(strtolower($order['delivery_location'] ?? ''), strtolower($this->search));
            }),
        ])->layout('layouts.app');
    }
}