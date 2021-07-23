<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-black p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-2"
            href="{{ route('dashboard.home') }}">
            {{-- <div class="sidebar-brand-icon" style="background-color: white;padding: 10px;border-radius: 50px">
                <img
                    src="{{ asset('assets/img/qnitimada.svg') }}" width="50px" style="">
                </div> --}}
            <div class="sidebar-brand-text mx-3"><img src="{{ asset('assets/img/tuttutlogo.png') }}" width="150"
                    height="50" alt=""></div>
        </a>
        {{-- {{dd($currentMusim)}} --}}


        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            @if (Request::is('dashboard*') || Request::is('/') || Request::is('home'))
                <li class="nav-item"><a class="nav-link"><span class="spanstyle">Selamat Datang</span></a></li>
            @endif
            <li class="nav-item"><a class="nav-link"><span class="spanstyle">{{ Auth::user()->name }}</span></a></li>
            <li class="nav-item"><a
                    class="nav-link {{ Request::is('dashboard*') || Request::is('/') || Request::is('home') ? 'active' : '' }}"
                    href="{{ route('dashboard.home') }}"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  Dropdown link
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Link 1</a>
                  <a class="dropdown-item" href="#">Link 2</a>
                  <a class="dropdown-item" href="#">Link 3</a>
                </div>
              </li> --}}

            <li class="nav-item"><a class="nav-link {{ Request::is('order*') ? 'active' : '' }}"
                    href="{{ route('dashboard.order.menu') }}"><i class="fas fa-user"></i><span>Order</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('restaurant*') ? 'active' : '' }}"
                    href="{{ route('dashboard.restaurant.menu') }}"><i
                        class="fas fa-user"></i><span>Restaurant</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('deliverer') ? 'active' : '' }}"
                    href="{{ route('dashboard.deliverer.menu') }}"><i
                        class="fas fa-user"></i><span>Deliverer</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('foodmenu*') ? 'active' : '' }}"
                    href="{{ route('dashboard.foodmenu.index') }}"><i class="fas fa-user"></i><span>Food
                        Menu</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('deliverercredit*') ? 'active' : '' }}"
                    href="{{ route('dashboard.deliverercredit.index') }}"><i class="fas fa-user"></i><span>Deliverer Credit</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('sellercredit*') ? 'active' : '' }}"
                    href="{{ route('dashboard.sellercredit.index') }}"><i class="fas fa-user"></i><span>Seller Credit</span></a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('delivererhistorycredit*') ? 'active' : '' }}"
                        href="{{ route('dashboard.delivererhistorycredit.index') }}"><i class="fas fa-user"></i><span>Deliverer Credit History</span></a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('sellerhistorycredit*') ? 'active' : '' }}"
                        href="{{ route('dashboard.sellerhistorycredit.index') }}"><i class="fas fa-user"></i><span>Seller Credit History</span></a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('mesejinfo*') ? 'active' : '' }}"
                    href="{{ route('dashboard.mesejinfo.menu') }}"><i class="fas fa-envelope"></i><span>Push Message</span></a></li>
            @if (Auth::user()->admintype == 'main')
                <li class="nav-item"><a class="nav-link {{ Request::is('region*') ? 'active' : '' }}"
                        href="{{ route('dashboard.region.index') }}"><i
                            class="fas fa-map-marker"></i><span>Region</span></a></li>
            @endif

            <li class="nav-item "><a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                        class="fas fa-sign-out-alt"></i><span>{{ __('Logout') }}</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        {{-- <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle"
                type="button"></button></div> --}}
    </div>
</nav>
