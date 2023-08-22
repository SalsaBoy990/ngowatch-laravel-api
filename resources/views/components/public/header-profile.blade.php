<header class="page-header">
    <div class="header-content">
        <div class="logo">
            <a href="{{ route('public.profile', $handler) }}" class="brand">
                <img src="{{ url('/images/memolife-small.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                {{ $handler }}
            </a>
        </div>
        @if (Route::has('login'))
            <div class="main-navigation">
                <nav id="main-menu" class="fs-16">

                    <a class="{{ request()->routeIs('public.profile') ? 'active' : '' }}"
                       href="{{ route('public.profile', $handler) }}">
                        <i class="fa-regular fa-user margin-right-0-5"></i>{{ __('Public Profile') }}
                    </a>

                    @auth
                        <a class="{{ request()->routeIs('spa') ? 'active' : '' }}"
                           href="{{ route('spa') }}">
                            <i class="fa-regular fa-images margin-right-0-5"></i>{{ __('Your Memories') }}
                        </a>

                        <a class="{{ request()->routeIs('user.account') ? 'active' : '' }}"
                           href="{{ route('user.account', auth()->id()) }}">
                            <i class="fa-regular fa-cog margin-right-0-5"></i>{{ __('Your account') }}
                        </a>

                        <x-global.user-drop-down-menu :className="'mobile-menu-only'"/>
                    @endauth
                </nav>


                <div x-data="offCanvasMenuData">
                    <div class="flex flex-row">

                        <button id="main-menu-offcanvas-toggle"
                                @click="toggleOffcanvasMenu()"
                                class="primary alt margin-left-0-5"
                                data-collapse-toggle="navbar-default"
                                type="button"
                                aria-controls="navbar-default"
                                aria-expanded="false"
                        >
                            <span class="sr-only">{{__('Open main menu')}}</span>
                            <i :class="sidenav === true ? 'fa fa-times' : 'fa fa-bars'" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="sidenav relative"
                         tabindex="-1"
                         id="main-menu-offcanvas"
                         @click.outside="closeOnOutsideClick()"
                    >
                        <a href="javascript:void(0)"
                           id="main-menu-close-button"
                           @click="closeOffcanvasMenu()"
                           class="close-button fs-18 absolute topright padding-0-5"
                        >
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>

                        <div id="mobile-menu"></div>

                    </div>

                </div>


            </div>
            <div class="right-menu">
                @php
                    $light = __('Light mode');
                    $dark = __('Dark mode');
                @endphp
                <button
                    class="darkmode-toggle margin-top-0"
                    rel="button"
                    @click="toggleDarkMode"
                    x-text="isDarkModeOn() ? '🔆' : '🌒'"
                    :title="isDarkModeOn() ? '{{ $light }}' : '{{ $dark }}'"
                >
                </button>

                @guest
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="button register-button margin-top-0">{{ __('Register') }}</a>
                    @endif
                    <a href="{{ route('login') }}"
                       class="button login-button margin-top-0">{{ __('Log in') }}</a>
                @endguest

                @auth
                    <div class="logout">
                        <a class="button logout-button"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>

                        <form
                            id="logout-form"
                            action="{{ route('logout') }}"
                            method="POST"
                            class="d-none"
                        >
                            @csrf
                        </form>
                    </div>
                @endauth

            </div>
        @endif
    </div>
</header>


