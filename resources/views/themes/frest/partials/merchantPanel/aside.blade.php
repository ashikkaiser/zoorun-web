        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('merchant.dashboard') }}" class="app-brand-link">
                    <img src="/app/{{ settings()->logo }}" alt="" style="width: 70%;"
                        class="pp-brand-text demo menu-text fw-bold ms-2">
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
                    <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-divider mt-0"></div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Page -->
                <li class="menu-item {{ request()->route()->getName() === 'merchant.dashboard'? 'active': '' }}">
                    <a href="{{ route('merchant.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'merchant.profile'? 'active': '' }}">
                    <a href="{{ route('merchant.profile') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                        <div data-i18n="Page 1">Merchant Profile</div>
                    </a>
                </li>
                {{-- Parcel Menu --}}
                <li class="menu-item  {{ strpos(\Request::path(), '/parcel/booking') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cart-add"></i>
                        <div data-i18n="Dashboards">Parcel Booking</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'merchant.parcel.booking.create'? 'active': '' }}">
                            <a href="{{ route('merchant.parcel.booking.create') }}" class="menu-link">
                                <div data-i18n="Analytics">Add Parcel</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'merchant.parcel.booking.list'? 'active': '' }}">
                            <a href="{{ route('merchant.parcel.booking.list') }}" class="menu-link">
                                <div data-i18n="eCommerce">Parcel List</div>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Account Menu --}}
                <li class="menu-item  {{ strpos(\Request::path(), '/account/delivery') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-wallet"></i>
                        <div data-i18n="Dashboards">Account</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'merchant.account.delivery.payment.list'? 'active': '' }}">
                            <a href="{{ route('merchant.account.delivery.payment.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Delivery Payment List</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'merchant.account.delivery.parcel.list'? 'active': '' }}">
                            <a href="{{ route('merchant.account.delivery.parcel.list') }}" class="menu-link">
                                <div data-i18n="eCommerce">Delivery Parcel List</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'merchant.order.track'? 'active': '' }}">
                    <a href="{{ route('merchant.order.track') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-target-lock"></i>
                        <div data-i18n="Page 1">Order Tracking</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'merchant.coverage.area'? 'active': '' }}">
                    <a href="{{ route('merchant.coverage.area') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-map"></i>
                        <div data-i18n="Page 1">Coverage Area</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'merchant.service.charge'? 'active': '' }}">
                    <a href="{{ route('merchant.service.charge') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet"></i>
                        <div data-i18n="Page 1">Service Charge</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'merchant.pickup.point'? 'active': '' }}">
                    <a href="{{ route('merchant.pickup.point') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-map-pin"></i>
                        <div data-i18n="Page 1">Pickup Points</div>
                    </a>
                </li>

            </ul>
        </aside>
