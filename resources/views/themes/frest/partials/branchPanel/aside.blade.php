        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('branch.dashboard') }}" class="app-brand-link">
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
                <li class="menu-item {{ request()->route()->getName() === 'branch.dashboard'? 'active': '' }}">
                    <a href="{{ route('branch.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'branch.profile'? 'active': '' }}">
                    <a href="{{ route('branch.profile') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                        <div data-i18n="Page 1">Branch Profile</div>
                    </a>
                </li>


                <li class="menu-item  {{ strpos(\Request::path(), '/parcel/pickup') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-sitemap"></i>
                        <div data-i18n="Dashboards">Pickup Percel</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.pickup.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.pickup.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Pickup Percel List</div>
                            </a>
                        </li>

                        {{-- Completed but not usinf in current Model --}}
                        {{-- <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.pickup.generate'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.pickup.generate') }}" class="menu-link">
                                <div data-i18n="eCommerce">Generate Pickup Rider</div>
                            </a>
                        </li> --}}
                        {{-- Completed but not usinf in current Model --}}

                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.pickup.rider.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.pickup.rider.list') }}" class="menu-link">
                                <div data-i18n="eCommerce">Pickup Rider List</div>
                            </a>
                        </li>

                        {{-- <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.transfer.generate'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.transfer.generate') }}" class="menu-link">
                                <div data-i18n="Analytics">Generate Branch Transfer</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.transfer.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.transfer.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Delivery Branch Transfer List</div>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="menu-item  {{ strpos(\Request::path(), '/parcel/delivery') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-package"></i>
                        <div data-i18n="Dashboards">Delivery Parcel</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.delivery.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.delivery.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Delivery Percel List</div>
                            </a>
                        </li>
                        {{-- <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.delivery.generate'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.delivery.generate') }}" class="menu-link">
                                <div data-i18n="eCommerce">Generate Delivery Rider</div>
                            </a>
                        </li> --}}
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.delivery.rider.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.delivery.rider.list') }}" class="menu-link">
                                <div data-i18n="eCommerce">Delivery Rider List</div>
                            </a>
                        </li>
                        {{-- <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.item'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.item') }}" class="menu-link">
                                <div data-i18n="Analytics">Item</div>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="menu-item  {{ strpos(\Request::path(), 'return-parcel') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-reset"></i>
                        <div data-i18n="Dashboards">Return Parcel</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.return.parcel.list'? 'active': '' }}">
                            <a href="{{ route('branch.return.parcel.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Return Percel List</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.return.rider.list'? 'active': '' }}">
                            <a href="{{ route('branch.return.rider.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Return Rider List</div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Booking menu --}}
                {{-- <li class="menu-item  {{ strpos(\Request::path(), '/parcel/booking') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cart-add"></i>
                        <div data-i18n="Dashboards">Parcel Booking</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.booking.list'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.booking.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Parcel Booking List</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.booking.create'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.booking.create') }}" class="menu-link">
                                <div data-i18n="eCommerce">Add New Parcel Booking</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.item.category'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.item.category') }}" class="menu-link">
                                <div data-i18n="eCommerce">Item Category</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.item'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.item') }}" class="menu-link">
                                <div data-i18n="Analytics">Item</div>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- Booking menu --}}
                <li class="menu-item  {{ strpos(\Request::path(), '/parcel-setting') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div data-i18n="Dashboards">Parcel Setting</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.vehicle'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.vehicle') }}" class="menu-link">
                                <div data-i18n="Analytics">Vehicle</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.unit'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.unit') }}" class="menu-link">
                                <div data-i18n="eCommerce">Unit</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.item.category'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.item.category') }}" class="menu-link">
                                <div data-i18n="eCommerce">Item Category</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.parcel.setting.item'? 'active': '' }}">
                            <a href="{{ route('branch.parcel.setting.item') }}" class="menu-link">
                                <div data-i18n="Analytics">Item</div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Accounts menu --}}
                <li class="menu-item  {{ strpos(\Request::path(), '/accounts') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div data-i18n="Dashboards">Accounts</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.accounts.delivery.payment.list'? 'active': '' }}">
                            <a href="{{ route('branch.accounts.delivery.payment.list') }}" class="menu-link">
                                <div data-i18n="Analytics">Branch Delivery Payment List</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.accounts.merchant.delivery.payment'? 'active': '' }}">
                            <a href="{{ route('branch.accounts.merchant.delivery.payment') }}" class="menu-link">
                                <div data-i18n="eCommerce">Merchant Delivery Payment</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'branch.accounts.merchant.delivery.payment.list'? 'active': '' }}">
                            <a href="{{ route('branch.accounts.merchant.delivery.payment.list') }}"
                                class="menu-link">
                                <div data-i18n="eCommerce">Merchant Delivery Payment List</div>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Accounts menu --}}
                <li class="menu-item {{ request()->route()->getName() === 'branch.order.track'? 'active': '' }}">
                    <a href="{{ route('branch.order.track') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-target-lock"></i>
                        <div data-i18n="Page 1">Order Tracking</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'branch.merchant.list'? 'active': '' }}">
                    <a href="{{ route('branch.merchant.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-check"></i>
                        <div data-i18n="Page 1">Branch Merchant List</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'branch.rider.list'? 'active': '' }}">
                    <a href="{{ route('branch.rider.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-run"></i>
                        <div data-i18n="Page 1">Branch Rider List</div>
                    </a>
                </li>
            </ul>
        </aside>
