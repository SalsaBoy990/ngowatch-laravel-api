<nav class="breadcrumb" style="max-width: 960px;margin: 0 auto;padding-bottom: 0.25em; width: 100%;">
    <ol style="{{ $centerAlign ? 'justify-content: center;width: 100%;' : '' }}">
        <li>
            <a href="{{ route('blog.index') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ __('Home') }}
            </a>
        </li>
        <li>
            <span>/</span>
        </li>
        <li>{{ $title }}</li>
    </ol>
</nav>
