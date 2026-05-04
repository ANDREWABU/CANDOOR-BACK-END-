{{-- @dd(Route::currentRouteName()) --}}
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper shadow">
            <a href="{{ route('/') }}">
                {{-- <img class="img-fluid mb-n2" src="{{ asset('assets/images/logo/career-sapce-logo.png') }}" alt=""
                    style="width: 180px"> --}}
                <img class="img-fluid mb-n2" src="{{ asset('assets/images/logo/logo2.png') }}" alt=""
                    style="width: 120px">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('/') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo1.png') }}" alt="" style="width: 41px;"></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('/') }}"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>

                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">User Details</h6>
                            <p class="lan-2">User details with their roles and status</p>
                        </div>
                    </li>
                    <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'user' ? 'active' : '' }}"
                            href="#"><i data-feather="users"></i><span class="lan-3">Users</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'user'
                                        ? 'down'
                                        : 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ Route::getCurrentRoute()->uri== 'user'
                                ? 'block;'
                                : 'none;' }}">

                            <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'user' ? 'active' : '' }}"
                                    href="{{ url('/user') }}">User List</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">Candoor Spaces</h6>
                            <p class="lan-2">Candoor Dynamic Spaces Add/Edit/Update</p>
                        </div>
                    </li>
                    {{-- <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'dashboard/spaces' ? 'active' : '' }}"
                            href="#"><i data-feather="stop-circle"></i><span class="lan-3">Spaces</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'dashboard/spaces'
                                        ? 'down'
                                        : 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ Route::getCurrentRoute()->uri== 'dashboard/spaces'
                                ? 'block;'
                                : 'none;' }}">

                            <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'dashboard/spaces' ? 'active' : '' }}"
                                    href="{{ url('dashboard/spaces') }}">Spaces List</a></li>
                        </ul>
                        </li> --}}
                        <li class="sidebar-list"><a
                                class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'dashboard/degrees' ? 'active' : '' }}"
                                href="#"><i data-feather="stop-circle"></i><span class="lan-3">Degrees</span>
                                <div class="according-menu"><i
                                        class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'dashboard/degrees'
                                            ? 'down'
                                            : 'right' }}"></i>
                                </div>
                            </a>
                            <ul class="sidebar-submenu"
                                style="display: {{ Route::getCurrentRoute()->uri== 'dashboard/degrees'
                                    ? 'block;'
                                    : 'none;' }}">

                                <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'dashboard/degrees' ? 'active' : '' }}"
                                        href="{{ url('dashboard/degrees') }}">Degrees List</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'dashboard/schools' ? 'active' : '' }}"
                            href="#"><i data-feather="stop-circle"></i><span class="lan-3">Schools</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'dashboard/schools'
                                        ? 'down'
                                        : 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ Route::getCurrentRoute()->uri== 'dashboard/schools'
                                ? 'block;'
                                : 'none;' }}">

                            <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'dashboard/schools' ? 'active' : '' }}"
                                    href="{{ url('dashboard/schools') }}">Schools List</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a
                        class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'dashboard/fieldsOFStudy' ? 'active' : '' }}"
                        href="#"><i data-feather="stop-circle"></i><span class="lan-3">Fields Of Study</span>
                        <div class="according-menu"><i
                                class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'dashboard/fieldsOFStudy'
                                    ? 'down'
                                    : 'right' }}"></i>
                        </div>
                    </a>
                    <ul class="sidebar-submenu"
                        style="display: {{ Route::getCurrentRoute()->uri== 'dashboard/fieldsOFStudy'
                            ? 'block;'
                            : 'none;' }}">

                        <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'dashboard/fieldsOFStudy' ? 'active' : '' }}"
                                href="{{ url('/dashboard/fieldsOFStudy') }}">Fileds of Study List</a></li>
                    </ul>
                </li>
                    <li class="sidebar-list"><a
                        class="sidebar-link sidebar-title {{ Route::getCurrentRoute()->uri == 'dashboard/companies' ? 'active' : '' }}"
                        href="#"><i data-feather="stop-circle"></i><span class="lan-3">Company</span>
                        <div class="according-menu"><i
                                class="fa fa-angle-{{Route::getCurrentRoute()->uri  == 'dashboard/companies'
                                    ? 'down'
                                    : 'right' }}"></i>
                        </div>
                    </a>
                    <ul class="sidebar-submenu"
                        style="display: {{ Route::getCurrentRoute()->uri== 'dashboard/companies'
                            ? 'block;'
                            : 'none;' }}">

                        <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'dashboard/companies' ? 'active' : '' }}"
                                href="{{ url('/dashboard/companies') }}">Companies List</a></li>
                    </ul>
                </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">Site Settings</h6>
                            <p class="lan-2">User and App settings</p>
                        </div>
                    </li>
                    <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{ request()->route()->getPrefix() == '/settings' ? 'active' : '' }}"
                            href="#"><i data-feather="settings"></i><span class="lan-3">Settings</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{request()->route()->getPrefix()  == '/settings'
                                        ? 'down'
                                        : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="sidebar-submenu"
                            style="display: {{ request()->route()->getPrefix()== '/settings'
                                ? 'block;'
                                : 'none;' }}">

                            <li><a class="lan-4 {{ Route::getCurrentRoute()->uri == 'settings' ? 'active' : '' }}"
                                    href="{{ url('/settings') }}">Experience/Role Settings</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName() == 'hiring-roles.index' ? 'active' : '' }}"
                                    href="{{ url('/settings/hiring-roles') }}">Hirring Roles</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName() == 'languages.index' ? 'active' : '' }}"
                                href="{{ url('/settings/languages') }}">Languages</a></li>
                            <li><a class="lan-4 {{ Route::currentRouteName() == 'hiring-budget.index' ? 'active' : '' }}"
                                href="{{ url('/settings/hiring-budget') }}">Hiring Budgets</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
