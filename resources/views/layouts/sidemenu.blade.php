<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
					<a href="{{ route('admin.dashboard') }}">
						<img src="{{ URL::asset('assets/img/icons/dashboard.svg') }}" alt="img">
						<span>Dashboard</span>
					</a>
				</li>
				
				@if (Auth::user()->role_id == 1)
				<li class="{{ request()->routeIs('admin.role.index') ? 'active' : '' }}">
					<a href="{{ route('view.admin') }}">
						<img src="{{ URL::asset('assets/img/icons/users1.svg') }}" alt="img">
						<span>Admin</span>
					</a>
				</li>
				@endif

				@if (Auth::user()->role_id == 1)
				<li class="{{ request()->routeIs('admin.role.index') ? 'active' : '' }}">
					<a href="{{ route('view.admin') }}">
						<img src="{{ URL::asset('assets/img/icons/users1.svg') }}" alt="img">
						<span>App User</span>
					</a>
				</li>

				
				<li class="submenu">
				<a href="javascript:void(0);" class="{{ request()->is('admin/attendence*') || request()->is('admin/factory_in_out*') || request()->is('admin/factory_in_out_real*')  ? 'active' : '' }}">
					<img src="{{ URL::asset('assets/img/icons/purchase1.svg') }}" alt="img">
					<span>Access Control</span>
					<span class="menu-arrow"></span>
				</a>
				<ul>
					<!-- Staff Attendance Menu Item -->
					<li>
						<a href="{{route('admin.role.index')}}" class="{{ request()->routeIs('admin.role.index') ? 'active' : '' }}">
							Role
						</a>
					</li>
					<li>
						<a href="{{route('admin.module.index')}}" class="{{ request()->routeIs('admin.module.index') ? 'active' : '' }}">
							Module
						</a>
					</li>

				
				</ul>
				</li>
                

				<li class="submenu">
					<a href="javascript:void(0);" class="{{ request()->is('admin/attendence*') || request()->is('admin/factory_in_out*') || request()->is('admin/factory_in_out_real*')  ? 'active' : '' }}">
						<img src="{{ URL::asset('assets/img/icons/purchase1.svg') }}" alt="img">
						<span>Music</span>
						<span class="menu-arrow"></span>
					</a>
					<ul>
						<!-- Staff Attendance Menu Item -->
						<li>
							<a href="{{route('category.view')}}" class="{{ request()->routeIs('category.view') ? 'active' : '' }}">
								Category
							</a>
						</li>
						<li>
							<a href="{{route('admin.module.index')}}" class="{{ request()->routeIs('admin.module.index') ? 'active' : '' }}">
								Subcategory
							</a>
						</li>
	
					
					</ul>
					</li>






			
				@endif

				

			</ul>
		</div>
	</div>
</div>