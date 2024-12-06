@php
use Illuminate\Support\Str;
$auth = Backend::GetAdmin();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link text-center" target="_blank">
        {{-- <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Website name</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile.create') }}" class="d-block">{{ $auth->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Categories route -->
                @if (Auth::guard('admin')->user()->can('categories view'))
                <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.category.') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.category.') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-th" aria-hidden="true"></i>
                        <p>
                            Category Management
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::guard('admin')->user()->can('categories view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.category.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('sub-categories view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.category.sub.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.category.sub.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- page route -->
                @if (Auth::guard('admin')->user()->can('page view'))
                <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.page.') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.page.') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-th" aria-hidden="true"></i>
                        <p>
                            Page Management
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::guard('admin')->user()->can('categories view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.page.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('sub-categories view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.category.sub.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.page.create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- Contact route -->
                @if (Auth::guard('admin')->user()->can('contacts view'))
                <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.contact.') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.contact.') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>
                            Contact management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::guard('admin')->user()->can('contacts view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.contact.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact information</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('branch view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.branch.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.contact.branch.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Branch information</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- Slider -->
                @if (Auth::guard('admin')->user()->can('slider view'))
                <li class="nav-item">
                    <a href="{{ route('admin.slider.index') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.index.create' ? 'active' : '' }}">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Sliders
                        </p>
                    </a>
                </li>
                @endif
                <!-- Setting route -->
                <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.setting.') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.setting.') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::guard('admin')->user()->can('admins view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.admin') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.admin' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('permissions view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.permission') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.permission' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('roles view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.role') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.role' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('navigation view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.navigation.create') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.navigation.create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navigation setting</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::guard('admin')->user()->can('index view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.index.create') }}" class="nav-link {{ Route::current()->getName() == 'admin.setting.index.create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Index setting</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" role="button" onclick="$('.admin-logout').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
