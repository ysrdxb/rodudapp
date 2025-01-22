<div>
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="card-title h4 mb-0 text-primary fw-bold">
                        <i class="fas fa-boxes me-2"></i>Order Management
                    </h2>
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input 
                                type="text" 
                                wire:model.live="search" 
                                class="form-control ps-5" 
                                placeholder="Search orders..."
                                style="min-width: 250px;">
                        </div>
                        <select wire:model.live="statusFilter" class="form-select border-primary" style="min-width: 150px;">
                            <option value="">All Statuses</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
    
            <div class="card-body p-4">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
    
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="fw-semibold">Order ID</th>
                                <th class="fw-semibold">Pickup Location</th>
                                <th class="fw-semibold">Delivery Location</th>
                                <th class="fw-semibold">Size</th>
                                <th class="fw-semibold">Weight</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="fw-semibold text-primary">#{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            {{ $order->pickup_location }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-flag-checkered text-success me-2"></i>
                                            {{ $order->delivery_location }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $order->size }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->weight }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ getStatusColor($order->status) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            @foreach ($statuses as $status)
                                                @if ($status !== $order->status)
                                                    <button 
                                                        wire:click="updateStatus({{ $order->id }}, '{{ $status }}')"
                                                        class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Update to {{ $status }}">
                                                        {{ $status }}
                                                    </button>
                                                @endif
                                            @endforeach

                                            <button 
                                                wire:click="showOrderDetails({{ $order->id }})"
                                                class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="tooltip"
                                                title="View Order Details">
                                                View Details
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3"></i>
                                        <p class="mb-0">No orders found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
    
                <div class="d-flex justify-content-end mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    @if ($orderDetails)
        <div class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <strong>Order ID:</strong> #{{ $orderDetails->id }}<br>
                            <strong>Pickup Location:</strong> {{ $orderDetails->pickup_location }}<br>
                            <strong>Delivery Location:</strong> {{ $orderDetails->delivery_location }}<br>
                            <strong>Size:</strong> {{ $orderDetails->size }}<br>
                            <strong>Weight:</strong> {{ $orderDetails->weight }}<br>
                            <strong>Status:</strong> {{ $orderDetails->status }}
                        </div>
                        
                        <form wire:submit.prevent="sendMessage" class="mt-3">
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea wire:model="message" id="message" class="form-control" rows="4"></textarea>
                                @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
