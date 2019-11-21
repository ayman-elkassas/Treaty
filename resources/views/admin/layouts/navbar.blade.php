<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

{{--        include menu file--}}
        @include('admin.layouts.menu')

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/')}}/design/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{admin()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
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
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="{{aurl('')}}">
                    <i style="color: #00b1e9;" class="fa fa-archive"></i> <span>Admin Panel</span>

                </a>
            </li>
            <li class="treeview">
                <a href="{{aurl('')}}">
                    <i style="color: #e96f00;" class="fa fa-dashboard"></i> <span>{{trans('admin.dashboard')}}</span>
                    <i class="fa fa-angle-left pull-right"></i>

                </a>

                <ul class="treeview-menu">
                    <li class=""><a href="{{aurl('settings')}}"><i class="fa fa-gears"></i> {{trans('admin.setting')}}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('admin')[0]}}">
                <a href="#">
                    <i style="color: #e9e800;" class="fa fa-user-secret"></i> <span>{{trans('admin.admin')}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('admin')[1]}}">
                    <li class=""><a href="{{aurl('admin')}}"><i class="fa fa-user-secret"></i> {{trans('admin.admin')}}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('users')[0]}}">
                <a href="#">
                    <i style="color: #6a6f25;" class="fa fa-users"></i> <span>Users Accounts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('users')[1]}}">
{{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('users')}}?level=user"><i style="color: #e9e800;" class="fa fa-user"></i> {{trans('admin.user')}}</a></li>
                    <li class=""><a href="{{aurl('users')}}?level=vendor"><i style="color: #e96f00;" class="fa fa-venus-mars"></i> {{trans('admin.vendor')}}</a></li>
                    <li class=""><a href="{{aurl('users')}}?level=company"><i style="color: #00b1e9;" class="fa fa-building"></i> {{trans('admin.company')}}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('countries')[0]}}">
                <a href="#">
                    <i style="color: #e96f00;" class="fa fa-flag"></i> <span>Countries</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('countries')[1]}}">
{{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('countries')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Countries</a></li>
                    <li class=""><a href="{{aurl('countries/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview {{active_menu('cities')[0]}}">
                <a href="#">
                    <i style="color: #005ee9;" class="fa fa-building"></i> <span>Cities</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('cities')[1]}}">
{{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('cities')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Cities</a></li>
                    <li class=""><a href="{{aurl('cities/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview {{active_menu('states')[0]}}">
                <a href="#">
                    <i style="color: #66e906;" class="fa fa-angellist"></i> <span>States</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('states')[1]}}">
{{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('states')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> States</a></li>
                    <li class=""><a href="{{aurl('states/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview {{active_menu('departments')[0]}}">
                <a href="#">
                    <i style="color: #00e98b;" class="fa fa-address-card-o"></i> <span>Departments</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('departments')[1]}}">
{{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('departments')}}"><i style="color: #e9e800;" class="fa fa-bomb"></i> Departments</a></li>
                    <li class=""><a href="{{aurl('departments/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('trademarks')[0]}}">
                <a href="#">
                    <i style="color: #cbe900;" class="fa fa-camera-retro"></i> <span>Trademarks</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('trademarks')[1]}}">
                    {{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('trademarks')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Trademarks</a></li>
                    <li class=""><a href="{{aurl('trademarks/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('manufacts')[0]}}">
                <a href="#">
                    <i style="color: #00b1e9;" class="fa fa-digg"></i> <span>Manufacts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('manufacts')[1]}}">
                    {{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('manufacts')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Manufacts</a></li>
                    <li class=""><a href="{{aurl('manufacts/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('shippings')[0]}}">
                <a href="#">
                    <i style="color: #e98f00;" class="fa fa-digg"></i> <span>Shippings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('shippings')[1]}}">
                    {{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('shippings')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Shippings</a></li>
                    <li class=""><a href="{{aurl('shippings/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('malls')[0]}}">
                <a href="#">
                    <i style="color: #3ae9e7;" class="fa fa-digg"></i> <span>Malls</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('malls')[1]}}">
                    {{--                    <li class=""><a href="{{aurl('users')}}"><i class="fa fa-users"></i> {{trans('admin.user')}}</a></li>--}}
                    <li class=""><a href="{{aurl('malls')}}"><i style="color: #e9e800;" class="fa fa-flag"></i> Malls</a></li>
                    <li class=""><a href="{{aurl('malls/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('colors')[0]}}">
                <a href="#">
                    <i style="color: #e96e00;" class="fa fa-digg"></i> <span>Colors</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('colors')[1]}}">
                    <li class=""><a href="{{aurl('colors')}}"><i style="color: #009ee9;" class="fa fa-car"></i> Colors</a></li>
                    <li class=""><a href="{{aurl('colors/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('sizes')[0]}}">
                <a href="#">
                    <i style="color: #00e0e9;" class="fa fa-sign-language"></i> <span>Sizes</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('sizes')[1]}}">
                    <li class=""><a href="{{aurl('sizes')}}"><i style="color: #009ee9;" class="fa fa-gamepad"></i> Size</a></li>
                    <li class=""><a href="{{aurl('sizes/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('weights')[0]}}">
                <a href="#">
                    <i style="color: #e9c407;" class="fa fa-empire"></i> <span>Weights</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('products')[1]}}">
                    <li class=""><a href="{{aurl('weights')}}"><i style="color: #009ee9;" class="fa fa-empire"></i> Weights</a></li>
                    <li class=""><a href="{{aurl('weights/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('products')[0]}}">
                <a href="#">
                    <i style="color: #47e92f;" class="fa fa-tag"></i> <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('products')[1]}}">
                    <li class=""><a href="{{aurl('products')}}"><i style="color: #009ee9;" class="fa fa-tag"></i> Products</a></li>
                    <li class=""><a href="{{aurl('products/create')}}"><i style="color: #e9e800;" class="fa fa-plus"></i> Add</a></li>
                </ul>
            </li>



            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>