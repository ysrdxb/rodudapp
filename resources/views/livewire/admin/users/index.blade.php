<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>User Management</h2>
        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if(!$showForm)
                <button wire:click="addUser" class="btn btn-primary mb-3">Add User</button>
            @endif

            @if($showForm)
                <button wire:click="cancelForm" class="btn btn-secondary mb-3">Go Back</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>{{ $selectedUser ? 'Edit User' : 'Create User' }}</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $selectedUser ? 'updateUser' : 'createUser' }}">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" wire:model="name" class="form-control">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" wire:model="email" class="form-control">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    @if(!$selectedUser)
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" wire:model="password" class="form-control">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ $selectedUser ? 'Update' : 'Create' }} User</button>
                        </form>
                    </div>
                </div>
            @else
                <h3>All Users</h3>
                <div class="mb-3">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search by name or email">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button wire:click="editUser({{ $user->id }})" class="btn btn-sm btn-warning">Edit</button>
                                        <button wire:click="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
