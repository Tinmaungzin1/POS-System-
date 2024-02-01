
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><i class="fa fa-paw"></i> <span>SG POS</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ URL::asset('asset/images/img.jpg') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{url('/sg-backend/index')}}"><i class="fa fa-home"></i> Dashboard </a>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Shift <span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/sg-backend/shift')}}">shift</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Category <span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/sg-backend/category/create')}}">Create category</a></li>
                            <li><a href="{{url('/sg-backend/category')}}">Category List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Item <span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/sg-backend/item/create')}}">Create Item</a></li>
                            <li><a href="{{url('/sg-backend/item')}}">Item List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Discount<span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/discount/create')}}">Discount Item</a></li>
                            <li><a href="{{url('/discount')}}">Discount List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Cashier<span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/cashier/create')}}">Cashier Create</a></li>
                            <li><a href="{{url('/cashier')}}">Cashier List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Admin<span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/cashier/create')}}">Admin Create</a></li>
                            <li><a href="{{url('/cashier')}}">Admin List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Setting<span class="fa fa-chevron-down"><span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/sg-backend/setting/create')}}">Create</a></li>
                            <li><a href="{{url('/sg-backend/setting')}}">List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>
