<footer class="page-footer public-footer" style="margin-top: 0; padding-bottom: 0">
    <div class="footer-content">

        <div class="logo margin-bottom-1">
            <a href="/" class="brand">
                <img src="{{ url('/images/memolife.png') }}" alt="{{ config('app.name', 'Laravel') }}">
            </a>
        </div>

        <nav>
            <a class="{{ request()->routeIs('frontpage') ? 'active' : '' }}"
               href="{{ url('/') }}">
                {{ __('Frontpage') }}</a>
            @auth
                <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    {{ __('Dashboard') }}</a>

                <a href="{{ route('spa') }}" class="">{{ __('Your memories') }}</a>
            @endauth
        </nav>
    </div>

    <div class="padding-top-bottom-1" style="background: #193F4D;">
        <small class="text-gray-40 fs-12">&copy; 2023 {{ config('app.name') }}
            . {{ __('All rights reserved!') }}</small>
    </div>
</footer>
