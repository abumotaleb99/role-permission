<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="" class="brand-link">
    <span class="brand-text font-weight-light">Role & Permission</span>
  </a>
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.roles.index') }}" class="nav-link  @if(Request::segment(2) == 'roles') active @endif">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Roles & Permissions
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.admins.index') }}" class="nav-link  @if(Request::segment(2) == 'admins') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Admins
            </p>
          </a>
        </li>
        {{-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Manage Page
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>