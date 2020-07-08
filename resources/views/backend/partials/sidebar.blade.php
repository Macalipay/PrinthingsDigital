<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PrinThings</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('dashboard')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Weekly</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('sales_order') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Sales Order
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('expense') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Daily Expense
              </p>
            </a>
          </li>
          <li class="nav-header">VIEWING</li>
          <li class="nav-item">
            <a href="{{ url('overall') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Overall Expense
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('payment') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Payment
              </p>
            </a>
          </li>
       
          <li class="nav-header">MAINTENANCE</li>
          <li class="nav-item">
            <a href="{{ url('client') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Client
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('category') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('expense_type') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Expense Type
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
