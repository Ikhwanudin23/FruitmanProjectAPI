<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{ asset('assets/images/background/user-info.jpg') }}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('assets/images/users/profile.png') }}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">FruitMan Admin</a>
                <div class="dropdown-menu animated flipInY">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" >{{ __('Logout') }}</a>

            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">FRUITMAN MANAJEMENT</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-checkbox-multiple-blank"></i><span class="hide-menu">Dashboard </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="has-arrow waves-effect waves-dark" href="{{route('index')}}" aria-expanded="false"><i class="mdi mdi-clipboard-check"></i>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Daftar Pengepul </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="has-arrow waves-effect waves-dark" href="{{route('userlist.index')}}" aria-expanded="false"><i class="mdi mdi-account-card-details"></i>&nbsp;&nbsp;&nbsp;Profil User Pengepul</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Daftar Penebas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="has-arrow waves-effect waves-dark" href="{{route('sellerlist.index')}}" aria-expanded="false"><i class="mdi mdi-account-card-details"></i>&nbsp;&nbsp;&nbsp;Profil User Penebas</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Laporan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a class="has-arrow waves-effect waves-dark" href="{{route('report.index')}}" aria-expanded="false"><i class="mdi mdi-account-card-details"></i>&nbsp;&nbsp;&nbsp;Data Transaksi User</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">

    </div>
    </div>
    <!-- End Bottom points-->
</aside>