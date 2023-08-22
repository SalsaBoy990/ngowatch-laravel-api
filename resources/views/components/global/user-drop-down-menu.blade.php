@auth
    <div
        x-data="dropdownData"
        role="button"
        aria-label="Legördülő menu"
        class="dropdown-click user-dropdown-menu relative {{ $className }}"
        @click.outside="hideDropdown"
    >
        <a @click="toggleDropdown">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>{{ Auth::user()->name }}</span>
            <i class="fa fa-caret-down"></i>
        </a>

        <div x-show="openDropdown" class="dropdown-content card padding-0-5">

            <a class="dropdown-item margin-bottom-1 {{ request()->routeIs('spa') ? 'active' : '' }}"
               href="{{ route('spa') }}"
            >
                <i class="fa fa-images" aria-hidden="true"></i>
                <span>{{ __('Your Memories') }}</span>
            </a>

            <a class="dropdown-item margin-bottom-1 {{ request()->routeIs('user.account') ? 'active' : '' }}"
               href="{{ route('user.account', auth()->id()) }}"
            >
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>{{ __('My Account') }}</span>
            </a>

            <a
                class="dropdown-item margin-bottom-1"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
            >
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
    </div>

@else
    <div class="user-dropdown-menu {{ $className }}">

    </div>
@endauth
