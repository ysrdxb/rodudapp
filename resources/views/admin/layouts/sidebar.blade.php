<div class="app-sidebar-menu">
	<div class="h-100" data-simplebar>

		<!--- Sidemenu -->
		<div id="sidebar-menu">

			<div class="logo-box">
				<a class='logo logo-light' href="{{ route('admin.dashboard') }}">
					<span class="logo-sm">
						<img src="{{ asset('admin/images/logo.png') }}" alt="KORT" height="22">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('admin/images/logo.png') }}" alt="KORT" height="24">
					</span>
				</a>
				<a class='logo logo-dark' href="{{ route('admin.dashboard') }}">
					<span class="logo-sm">
						<img src="{{ asset('admin/images/logo.png') }}" alt="KORT" height="22">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('admin/images/logo.png') }}" alt="KORT" height="65">
					</span>
				</a>
			</div>

			<ul id="side-menu mt-2">
	
				<li>
					<a href="{{ route('admin.dashboard') }}">
						<i data-feather="globe"></i>
						<span> Dashboard </span>
					</a>
				</li>
				
				<li>
					<a href="#orders" data-bs-toggle="collapse">
						<i data-feather="shopping-cart" class="menu-icon"></i>
						<span> Manage Orders </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="orders">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.orders.index') }}">
									<span> Orders </span>
								</a>
							</li>							
						</ul>
					</div>
				</li>
				

				<li>
					<a href="#users" data-bs-toggle="collapse">
						<i data-feather="users"></i>
						<span> Manage Users </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="users">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.users.index') }}">Users</a>
							</li>							
						</ul>
					</div>
				</li>

			</ul>

		</div>
		<!-- End Sidebar -->

		<div class="clearfix"></div>

	</div>
</div>