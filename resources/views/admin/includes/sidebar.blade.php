<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="mb-5">
                    <a class="d-flex" href="{{ route('home') }}" target="_blank">
                        <img width="28" alt="image" class="rounded-circle"
                             src="@if(empty($globalSettingInfo)) @else {{ $globalSettingInfo->image()->where('type', 'footer_logo')->first()->url }} @endif">
                        <span class="block m-t-xs font-bold ml-3">
                            @auth
                                {{ config('app.name') }}
                            @endauth
                   </span>
                    </a>
                </div>
                <div class="dropdown profile-element">
                    <img width="48" alt="image" class="rounded-circle"
                         src="{{ isset(Auth::user()->image) ? Auth::user()->image->url : asset('backend/img/profile/man.svg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">
                            @auth
                                {{ auth()->user()->name }}
                            @endauth
                        </span>
                        <span class="text-muted text-xs block">Administrator<b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"
                               onclick="document.getElementById('logout-form').submit()">Logout</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="{{ getActiveClassByRoute('admin.dashboard') }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('CategoryController') }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-list-ul"></i> <span class="nav-label">Categories</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('ProductController') }}">
                <a href="{{ route('admin.products.index') }}"><i class="fa fa-product-hunt"></i>
                    <span class="nav-label">Products</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('BrandController') }}">
                <a href="{{ route('admin.brands.index') }}"><i class="fa fa-bars"></i>
                    <span class="nav-label">Brands</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('OfferController') }}">
                <a href="{{ route('admin.offers.index') }}"><i class="fa fa-gift"></i>
                    <span class="nav-label">Offers</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('CustomerController') }}">
                <a href="{{ route('admin.customers.index') }}"><i class="fa fa-users"></i>
                    <span class="nav-label">Customers</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('SlidersController') }}">
                <a href="{{ route('admin.sliders.index') }}"><i class="fa fa-photo"></i>
                    <span class="nav-label">Sliders</span>
                </a>
            </li>

            <li class="{{ getActiveClassByController('OrderController') }}">
                <a href="javascript:void(0)"><i class="fa fa-bar-chart-o"></i>
                    <span class="nav-label">Order Manage</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class=""><a href="{{ route('admin.orders.index') }}">Pending Orders</a>
                    </li>
                    <li class=""><a href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Processing
                            Orders</a></li>
                    <li class=""><a href="{{ route('admin.orders.index',  ['status' => 'delivery']) }}">Delivery
                            Orders</a></li>
                    <li class=""><a href="{{ route('admin.orders.index', ['status' => 'complete']) }}">Complete
                            Orders</a></li>
                    <li class=""><a href="{{ route('admin.orders.index', ['status' => 'cancel']) }}">Cancel
                            Orders</a></li>
                </ul>
            </li>

            <li class="{{ getActiveClassByController('ShippingMethodController') }}">
                <a href="{{ route('admin.shipping-methods.index') }}"><i class="fa fa-truck"></i>
                    <span class="nav-label">Shipping Methods</span>
                </a>
            </li>
            @php($active_class = getActiveClassByController('SettingController') || getActiveClassByController('SocialController') ||  getActiveClassByController('TaxController'))
            <li class="{{ $active_class ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-bar-chart-o"></i>
                    <span class="nav-label">Manage Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('admin.settings.index') }}">Site Setting</a></li>
                    <li><a href="{{ route('admin.socials.index') }}">Social</a></li>
                    <li><a href="{{ route('admin.taxes.index') }}">Taxes</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
