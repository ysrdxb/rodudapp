<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

class OrderManagement extends Component
{
    use WithPagination;

    public $statuses = ['Pending', 'In Progress', 'Delivered'];
    public $search = '';
    public $statusFilter = '';
    public $orderDetails = null;
    public $message = '';
    public $selectedOrderId = null;

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        logger('Search:', [$this->search]);
        logger('Status Filter:', [$this->statusFilter]);
    
        $orders = Order::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('pickup_location', 'like', "%{$this->search}%")
                      ->orWhere('delivery_location', 'like', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
            ->paginate(10);
    
        return view('livewire.admin.orders.order-management', compact('orders'));
    }    

    public function updateStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);

        session()->flash('message', 'Order status updated successfully!');
    }

    public function showOrderDetails($orderId)
    {
        $this->orderDetails = Order::findOrFail($orderId);
        $this->selectedOrderId = $orderId;
    }

    public function sendMessage()
    {
        $order = Order::findOrFail($this->selectedOrderId);
        $user = User::find($order->user_id);

        Mail::to($user->email)->send(new \App\Mail\OrderMessage($order, $this->message));

        session()->flash('message', 'Message sent successfully!');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->message = '';
        $this->orderDetails = null;
        $this->selectedOrderId = null;
    }
}
