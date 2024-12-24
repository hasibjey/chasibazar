<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="z-index:1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">My site</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        {{-- <x-admin.layouts.messages/> --}}

        <!-- Notifications Dropdown Menu -->
        {{-- <x-admin.layouts.notifications/> --}}

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            @auth('admin')
                <a class="nav-link text-danger" data-widget="control-sidebar" data-slide="true" href="#" role="button" onclick="$('.admin-logout').submit()">
                    <i class="fas fa-power-off"></i>
                </a>
            @endauth
            @auth('customer')
                <a class="nav-link text-danger" data-widget="control-sidebar" data-slide="true" href="#" role="button" onclick="$('.customer-logout').submit()">
                    <i class="fas fa-power-off"></i>
                </a>
            @endauth
            @auth('web')
                <a class="nav-link text-danger" data-widget="control-sidebar" data-slide="true" href="#" role="button" onclick="$('#logout').submit()">
                    <i class="fas fa-power-off"></i>
                </a>
            @endauth
        </li>
    </ul>
</nav>
