  <nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="STP ASIQ" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3">
            STP<span class="font-medium"> ASIQ</span>
        </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('tower.dashboard') }}" class="side-menu xside-menu--activex">
                <div class="side-menu__icon">
                    <i data-feather="{{ __('home') }}"></i>
                </div>
                <div class="side-menu__title">
                    {{ __('Dashboard') }}
                </div>
            </a>
        </li>
        <div class="side-nav__devider my-6"></div>
        <li>
            <a href="javascript:;" class="side-menu ">
                <div class="side-menu__icon">
                    <i data-feather="{{ __('briefcase') }}"></i>
                </div>
                <div class="side-menu__title">
                    {{ __('Work Order') }}
                    <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('tower.wo.overview') }}" class="side-menu " rel="noopener noreferrer">
                        <div class="side-menu__icon">
                            <i data-feather="{{ __('tag') }}"></i>
                        </div>
                        <div class="side-menu__title">
                            {{ __('Overview') }}
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tower.wo.draft') }}" class="side-menu " rel="noopener noreferrer">
                        <div class="side-menu__icon">
                            <i data-feather="{{ __('tag') }}"></i>
                        </div>
                        <div class="side-menu__title">
                            {{ __('Draft') }}
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tower.wo.plan') }}" class="side-menu " rel="noopener noreferrer">
                        <div class="side-menu__icon">
                            <i data-feather="{{ __('tag') }}"></i>
                        </div>
                        <div class="side-menu__title">
                            {{ __('Plan') }}
                        </div>
                    </a>
                </li> 
                <li>
                    <a href="{{ route('tower.wo.release') }}" class="side-menu " rel="noopener noreferrer">
                        <div class="side-menu__icon">
                            <i data-feather="{{ __('tag') }}"></i>
                        </div>
                        <div class="side-menu__title">
                            {{ __('Release') }}
                        </div>
                    </a>
                </li> 
            </ul>
        </li>
    </ul>
    
</nav>