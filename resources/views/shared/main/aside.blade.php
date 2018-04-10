<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("adminlte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url("/dashboard") }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="header">Inventory</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#"><i class="fa fa-paperclip"></i> <span>Log</span></a></li>
            <li><a href="#"><i class="fa fa-th-list"></i> <span>Items</span></a></li>
            <li class="header">Admin</li>
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{ url("/admin/users") }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>