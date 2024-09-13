<aside class="left-side ">
    <section class="sidebar ">
        <div class="page-sidebar  sidebar-nav">
            <div class="nav_icons">
                <ul class="sidebar_threeicons">
                    <li>
                        <a href="{{ URL::to('admin/advanced_tables') }}">
                            <i class="livicon" data-name="table" title="Advanced tables" data-loop="true"
                               data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('admin/tasks') }}">
                            <i class="livicon" data-name="list-ul" title="Tasks" data-loop="true"
                               data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('admin/gallery') }}">
                            <i class="livicon" data-name="image" title="Gallery" data-loop="true"
                               data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('admin/users') }}">
                            <i class="livicon" data-name="user" title="Users" data-loop="true"
                               data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <ul id="menu" class="page-sidebar-menu">

                <li {!! (Request::is('/') ? 'class="active"' : '') !!}>
                    <a href="{{route('dashboard')}}"> {{-- {{ route('dashboard') }}--}}
                        <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                           data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                    <li {!! (Request::is('admin/users*') ? 'class="active"' : '') !!}>
                        <a href="#">
                            <i class="livicon" data-name="users" data-c="#F89A14" data-hc="#F89A14" data-size="18"
                               data-loop="true"></i>
                            <span class="title">Users</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li {!! (Request::is('admin/users') ? 'class="active"' : '') !!}>
                                <a href="{{ route('admin.users.index') }}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Index Users
                                </a>
                            </li>
                            <li {!! (Request::is('admin/users/create') ? 'class="active"' : '') !!}>
                                <a href="{{ route('admin.users.create')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Create Users
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li {!! (Request::is('shipStation/*') ? 'class="active"' : '') !!}>
                    <a href="#">
                        <i class="livicon" data-name="desktop" data-c="#F89A14" data-hc="#F89A14" data-size="18"
                           data-loop="true"></i>
                        <span class="title">Shipstation</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li {!! (Request::is('shipStation/productImport') ? 'class="active"' : '') !!}>
                            <a href="{{ route('shipStation.productImport') }}">
                                <i class="fa fa-download"></i>
                                Product Import (CSV)
                            </a>
                        </li>
                        <li {!! (Request::is('shipStation/aliasImport ') ? 'class="active"' : '') !!}>
                            <a href="{{ route('shipStation.aliasImport')}}">
                                <i class="fa fa-download"></i>
                                Alias Import (CSV)
                            </a>
                        </li>
                    </ul>
                </li>

                <li {!! (Request::is('catalog*') ? 'class="active"' : '') !!}>
                    <a href="{{ route('catalog.index') }}">
                        <i class="livicon" data-name="notebook" data-c="#ef6f6c" data-hc="#ef6f6c" data-size="18"
                           data-loop="true"></i>
                        Catalog
                    </a>
                </li>

                <li {!! (Request::is('inventory*') ? 'class="active"' : '') !!}>
                    <a href="{{ route('inventory.index') }}">
                        <i class="livicon" data-name="thumbnails-small" data-c="#ef6f6c" data-hc="#ef6f6c"
                           data-size="18"
                           data-loop="true"></i>
                        Inv Global
                    </a>
                </li>

                <li {!! (Request::is('market')  ? 'class="active"' : '') !!}>

                    <a href="{{ route('market.index') }}">
                        <i class="livicon" data-name="shopping-cart" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2"
                           data-loop="true"></i>
                        MarketPlace Mapping
                    </a>
                </li>
                <li {!! (Request::is('clean')  ? 'class="active"' : '') !!}>

                    <a href="{{ route('clean.index') }}">
                        <i class="livicon" data-name="cloud-up" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2"
                           data-loop="true"></i>
                        Clean Lunch
                    </a>
                </li>

                <!-- Menus generated by CRUD generator -->
                @include('layouts.menu')
            </ul>
        </div>
    </section>
</aside>
