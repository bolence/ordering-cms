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
                <div class="parent-icon"><i class="bx bx-plus"></i>
                </div>
                <div class="menu-title">Napravi porudžbinu</div>
            </a>

        </li>
        <li class="{{ request()->is('order' ? 'mm-active' : '') }}">
            <a href="/order">
                <div class="parent-icon"><i class="bx bx-table"></i>
                </div>
                <div class="menu-title">Porudžbine</div>
            </a>

        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
