<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('backendAssets/img/avatar3.png') }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Hello, Admin</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="javascript: ;">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <!-- category -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-list"></i>
                        <span>Category</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin-category.index') }}"><i class="fa fa-angle-double-right"></i>View Category</a></li>
                       
                    </ul>
                </li>
                <!-- Question -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-question"></i>
                        <span>Question</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin-question.index') }}"><i class="fa fa-angle-double-right"></i>View Question</a></li>
                       
                    </ul>
                </li>
                <!-- Question -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span>Options Label</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin-option.index') }}"><i class="fa fa-angle-double-right"></i>View Options</a></li>
                       
                    </ul>
                </li>
                <!-- Category Question -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Categories Questions</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin-cateques.index') }}"><i class="fa fa-angle-double-right"></i>View Category questions</a></li>
                       
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
