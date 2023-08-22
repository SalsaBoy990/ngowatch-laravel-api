<x-admin.layout.admin-layout>

    @section('content')

        <main class="padding-1">
            <h1 class="h2 margin-top-0 text-center">{{ __('Dashboard') }}</h1>

            <div class="dashboard-content">

                @auth
                    <ul class="dashboard-card-grid">

                        @role('super-administrator|administrator|customer')
                        <!-- Custom links -->
                        <li class="card text-center">
                            <a class="card-link" href="{{ route('spa') }}">
                                <i class="fa-solid fa-images"></i>
                                <span class="bold">{{ __('Your memories') }}</span>
                            </a>
                        </li>
                        @endrole

                        @role('super-administrator')
                        <!-- Manage users link -->
                        <li class="card text-center">
                            <a class="card-link" href="{{ route('user.manage') }}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                {{ __('Manage users') }}
                            </a>
                        </li>


                        <!-- Manage roles and permissions link -->
                        <li class="card text-center">
                            <a class="card-link" href="{{ route('role-permission.manage') }}">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                {{ __('Roles and Permissions') }}
                            </a>
                        </li>
                        @endrole

                        <!-- Account link -->
                        <li class="card text-center">
                            <a class="card-link" href="{{ route('user.account', auth()->id()) }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ __('My Account') }}</span>
                            </a>
                        </li>

                        <!-- Logout link -->
                        <li class="card text-center">
                            <a class="card-link"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form-dashboard').submit();"
                            >
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ __('Logout') }}
                            </a>
                            <form
                                id="logout-form-dashboard"
                                action="{{ route('logout') }}"
                                method="POST"
                                class="hide"
                            >
                                @csrf
                            </form>
                        </li>

                    </ul>
                @endauth
            </div>
        </main>
    @endsection

</x-admin.layout.admin-layout>
