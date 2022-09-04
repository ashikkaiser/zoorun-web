        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
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
                <li class="menu-item {{ request()->route()->getName() === 'admin.dashboard'? 'active': '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>

                <li class="menu-item  {{ strpos(\Request::path(), 'admin/team') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Dashboards">Team</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->route()->getName() === 'admin.team.branch'? 'active': '' }}">
                            <a href="{{ route('admin.team.branch') }}" class="menu-link">
                                <div data-i18n="Analytics">Branch</div>
                            </a>
                        </li>
                        <li class="menu-item ">
                            <a href="{{ route('admin.team.branch.users') }}"
                                class="menu-link {{ request()->route()->getName() === 'admin.team.branch.users'? 'active': '' }}">
                                <div data-i18n="eCommerce">Branch Users</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.team.merchant'? 'active': '' }}">
                            <a href="{{ route('admin.team.merchant') }}" class="menu-link">
                                <div data-i18n="Analytics">Marchants</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->route()->getName() === 'admin.team.rider'? 'active': '' }}">
                            <a href="{{ route('admin.team.rider') }}" class="menu-link">
                                <div data-i18n="Analytics">Riders</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.team.warehouse'? 'active': '' }}">
                            <a href="{{ route('admin.team.warehouse') }}" class="menu-link">
                                <div data-i18n="Analytics">Warehouse</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.team.warehouse.user'? 'active': '' }}">
                            <a href="{{ route('admin.team.warehouse.user') }}" class="menu-link">
                                <div data-i18n="Analytics">Warehouse User</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item  {{ strpos(\Request::path(), 'admin/application') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Dashboards">Application Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.weight.package'? 'active': '' }}">
                            <a href="{{ route('admin.application.weight.package') }}" class="menu-link">
                                <div data-i18n="Analytics">Weight Packages</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.service.area'? 'active': '' }}">
                            <a href="{{ route('admin.application.service.area') }}" class="menu-link">
                                <div data-i18n="eCommerce">Service Area</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.service.area.setting'? 'active': '' }}">
                            <a href="{{ route('admin.application.service.area.setting') }}" class="menu-link">
                                <div data-i18n="eCommerce">Service Area Setting</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.district'? 'active': '' }}">
                            <a href="{{ route('admin.application.district') }}" class="menu-link">
                                <div data-i18n="Analytics">Districts</div>
                            </a>
                        </li>


                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.zone'? 'active': '' }}">
                            <a href="{{ route('admin.application.zone') }}" class="menu-link">
                                <div data-i18n="eCommerce">Zone</div>
                            </a>
                        </li>

                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.application.area'? 'active': '' }}">
                            <a href="{{ route('admin.application.area') }}" class="menu-link">
                                <div data-i18n="eCommerce">Area</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item  {{ strpos(\Request::path(), '/parcel-setting') !== false ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                        <div data-i18n="Dashboards">Parcel Setting</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.parcel.setting.vehicle'? 'active': '' }}">
                            <a href="{{ route('admin.parcel.setting.vehicle') }}" class="menu-link">
                                <div data-i18n="Analytics">Vehicle</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.parcel.setting.unit'? 'active': '' }}">
                            <a href="{{ route('admin.parcel.setting.unit') }}" class="menu-link">
                                <div data-i18n="eCommerce">Unit</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.parcel.setting.item.category'? 'active': '' }}">
                            <a href="{{ route('admin.parcel.setting.item.category') }}" class="menu-link">
                                <div data-i18n="eCommerce">Item Category</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->route()->getName() === 'admin.parcel.setting.item'? 'active': '' }}">
                            <a href="{{ route('admin.parcel.setting.item') }}" class="menu-link">
                                <div data-i18n="Analytics">Item</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->route()->getName() === 'site.setting'? 'active': '' }}">
                    <a href="{{ route('site.setting') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-desktop"></i>
                        <div data-i18n="Page 1">Site Setting</div>
                    </a>
                </li>
            </ul>
        </aside>
