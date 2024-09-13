<header class="header">
    <a href="#" class="logo">
        <img src="{{ asset('img/admin_logo.png') }}" width="149" height="47" alt="logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right toggle">
            <ul class="nav navbar-nav  list-inline">
                <li class=" nav-item dropdown user user-menu">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <div class="riot">
                            <div>
                                <p class="user_name_max">{{ auth()->user()->fullName }}</p>
                                <span>
                                    <i class="caret"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{ asset('img/authors/avatar3.png') }}" alt="img" height="35px"
                                 width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                            <p class="topprofiletext">{{ auth()->user()->fullName }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="{{ URL::route('users.show',auth()->id()) }}">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                My Profile
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="gears" data-s="18"></i>
                                Account Settings
                            </a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#">
                                    <i class="livicon" data-name="lock" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i>
                                    Lock
                                </a>
                            </div>
                            <div class="pull-right">
                                <a onclick="document.getElementById('logout').submit()" href="#">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </div>
                            <form id="logout" action="{{route('logout')}}" method="POST">@csrf</form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>