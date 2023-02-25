<!-- sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">BedžStudio</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ request()->is('/' ? 'mm-active' : '') }}">
            <a href="/">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Početna strana</div>
            </a>

        </li>
        <li class="{{ request()->is('order/create' ? 'mm-active' : '') }}">
            <a href="/order/create">
                <div class="parent-icon"><i class="bx bx-shopping-bag"></i>
                </div>
                <div class="menu-title">Napravi porudžbinu</div>
            </a>

        </li>
        <li class="{{ request()->is('order/' ? 'mm-active' : '') }}">
            <a href="/order">
                <div class="parent-icon"><i class="bx bxs-t-shirt"></i>
                </div>
                <div class="parent-icon"><i class="bx bxs-badge"></i>
                </div>
                <div class="menu-title">Sve porudžbine</div>
            </a>
        </li>

        <li class="{{ request()->is('order/badges/finished' ? 'mm-active' : '') }}">
            <a href="/order/finished">
                <div class="parent-icon"><i class="bx bxs-badge"></i>
                </div>
                <div class="menu-title">Završene porudžbine</div>
            </a>
        </li>


        <li class="{{ request()->is('customers' ? 'mm-active' : '') }}">
            <a href="/customers">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Mušterije</div>
            </a>
        </li>

        <li class="{{ request()->is('bosko' ? 'mm-active' : '') }}">
            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
                </div>
                <div class="menu-title">Izloguj se</div>
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
