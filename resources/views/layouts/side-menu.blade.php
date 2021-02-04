
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="STP ASIQ" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                <span class="hidden xl:block text-white text-lg ml-3">
                    STP<span class="font-medium"> ASIQ</span>
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                @foreach ($side_menu as $menu)
                    @if ($menu == 'devider')
                        <li class="side-nav__devider my-6"></li>
                    @else
                        <li>
                            <a href="{{ isset($menu['layout']) ? route('page', ['layout' => $menu['layout'], 'theme' => $theme, 'pageName' => $menu['page_name']]) : 'javascript:;' }}" class="{{ $first_page_name == $menu['page_name'] ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="{{ $menu['icon'] }}"></i>
                                </div>
                                <div class="side-menu__title">
                                    {{ $menu['title'] }}
                                    @if (isset($menu['sub_menu']))
                                        <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                    @endif
                                </div>
                            </a>
                            @if (isset($menu['sub_menu']))
                                <ul class="{{ $first_page_name == $menu['page_name'] ? 'side-menu__sub-open' : '' }}">
                                    @foreach ($menu['sub_menu'] as $subMenu)
                                        <li>
                                            <a href="{{ isset($subMenu['layout']) ? route('page', ['layout' => $subMenu['layout'], 'theme' => $theme, 'pageName' => $subMenu['page_name']]) : 'javascript:;' }}" class="{{ $second_page_name == $subMenu['page_name'] ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                <div class="side-menu__icon">
                                                    <i data-feather="activity"></i>
                                                </div>
                                                <div class="side-menu__title">
                                                    {{ $subMenu['title'] }}
                                                    @if (isset($subMenu['sub_menu']))
                                                        <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                                                    @endif
                                                </div>
                                            </a>
                                            @if (isset($subMenu['sub_menu']))
                                                <ul class="{{ $second_page_name == $subMenu['page_name'] ? 'side-menu__sub-open' : '' }}">
                                                    @foreach ($subMenu['sub_menu'] as $lastSubMenu)
                                                        <li>
                                                            <a href="{{ isset($lastSubMenu['layout']) ? route('page', ['layout' => $lastSubMenu['layout'], 'theme' => $theme, 'pageName' => $lastSubMenu['page_name']]) : 'javascript:;' }}" class="{{ $third_page_name == $lastSubMenu['page_name'] ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                                <div class="side-menu__icon">
                                                                    <i data-feather="zap"></i>
                                                                </div>
                                                                <div class="side-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- END: Content -->
    </div>
