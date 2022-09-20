        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('warehouse.dashboard') }}" class="app-brand-link">
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
                <li class="menu-item {{ request()->route()->getName() === 'warehouse.dashboard'? 'active': '' }}">
                    <a href="{{ route('warehouse.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'warehouse.profile'? 'active': '' }}">
                    <a href="{{ route('warehouse.profile') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                        <div data-i18n="Page 1">Warehouse Profile</div>
                    </a>
                </li>

                <li class="menu-item  {{ strpos(\Request::path(), 'warehouse/parcel') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Dashboards">Parcel Booking</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'warehouse.booking.parcel'? 'active': '' }}">
                            <a href="{{ route('warehouse.booking.parcel') }}" class="menu-link">
                                <div data-i18n="Analytics">Booking Parcel List</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'warehouse.booking.operation'? 'active': '' }}">
                            <a href="{{ route('warehouse.booking.operation') }}" class="menu-link">
                                <div data-i18n="eCommerce">Booking Parcel Operation</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'warehouse.transfar.operation'? 'active': '' }}">
                            <a href="{{ route('warehouse.transfar.send.operation') }}" class="menu-link">
                                <div data-i18n="eCommerce">Transfar Parcel Operation</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'warehouse.booking.returnOperation'? 'active': '' }}">
                            <a href="{{ route('warehouse.booking.returnOperation') }}" class="menu-link">
                                <div data-i18n="eCommerce">Return Parcel Operation</div>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </aside>
