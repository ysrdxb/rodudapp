<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($createForm)
        <div class="card mb-3">
            <div class="card-header">
                <h4>{{ $order_id ? 'Edit' : 'Create' }} Shipping Request</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="{{ $order_id ? 'updateOrder' : 'createOrder' }}">

                    <div class="mb-3">
                        <label for="pickup_location" class="form-label">Pickup Location</label>
                        <input type="text" class="form-control" id="pickup_location" wire:model="pickup_location">
                        @error('pickup_location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="delivery_location" class="form-label">Delivery Location</label>
                        <input type="text" class="form-control" id="delivery_location" wire:model="delivery_location">
                        @error('delivery_location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="number" step="0.01" class="form-control" id="size" wire:model="size">
                        @error('size') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="number" step="0.01" class="form-control" id="weight" wire:model="weight">
                        @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="{{ $order_id ? 'updateOrder' : 'createOrder' }}">Processing...</span>
                        <span wire:loading.remove>Submit</span>
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="$set('createForm', false)">Go Back</button>
                </form>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-between mb-3">
            <input type="text" class="form-control w-50" placeholder="Search Orders..." wire:model="search">
            <button class="btn btn-success" wire:click="$set('createForm', true)">Create Order</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pickup Location</th>
                        <th>Delivery Location</th>
                        <th>Size</th>
                        <th>Weight</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order['pickup_location'] }}</td>
                            <td>{{ $order['delivery_location'] }}</td>
                            <td>{{ $order['size'] }}</td>
                            <td>{{ $order['weight'] }}</td>
                            <td>{{ $order['status'] }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" wire:click="editOrder({{ $order['id'] }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteOrder({{ $order['id'] }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>