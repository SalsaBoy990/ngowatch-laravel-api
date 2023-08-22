@extends('layouts.profile')

@section('header')
    <x-public.header-profile :handler="$user->userHandle" :userId="$user->id"></x-public.header-profile>
@endsection

@section('content')

    <div class="content-800 margin-left-right-auto">
        <div class="relative" style="height: 100%">
            <img src="{{ asset($gallery->cover_image) }}" alt="{{ $gallery->title }}"
                 class="hover-opacity card margin-bottom-1">

            @if (count($gallery->photos) > 0)
                <button id="open-light-gallery-button" class="primary absolute middle">
                    <i class="fa-regular fa-eye margin-right-0-5"></i>{{ __('View gallery') }}
                </button>

                <div id="lightgallery" class="container" style="display: none">

                    @foreach ($gallery->photos as $photo)
                        <a href="{{ asset($photo->full_image) }}"
                           class="relative"
                           data-title="{{ $photo->title }}"
                           data-sub-html="{!! '<h3>' .$photo->title.'</h3>'. $photo->description !!}"
                        >
                            <img class=""
                                 src="{{ asset($photo->full_image) }}"
                                 alt="{{ $photo->title }}">
                        </a>
                    @endforeach

                </div>
            @endif
        </div>
        <h1 class="h2 margin-top-0 text-center">{{ $gallery->title }}</h1>
        <div class="text-center">
            <div class="bold text-gray-60 margin-bottom-0-5">{{ $gallery->start . ' - ' . $gallery->end }}</div>
            <address class="fs-22">{{ $gallery->location }}</address>
        </div>

        @auth
            @if($user->id === Auth()->id())
                <div class="bar three margin-bottom-1-5 margin-top-1">
                    <a class="bar-item button primary"
                       href="{{ route('public.profile', $user->userHandle) }}">
                        <i class="fa-regular fa-images"></i>{{ __('Profile') }}
                    </a>

                    <a class="bar-item button primary"
                       href="{{ route('spa') }}"
                    >
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        {{ __('Dashboard') }}
                    </a>

                    <a class="bar-item button primary"
                       href="{{ route('user.account', auth()->id()) }}"
                    >
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{ __('My Account') }}
                    </a>
                </div>
            @endif
        @endauth


        <div>{!! $gallery->story !!}</div>


        <hr class="divider">


        <div class="content-600 margin-left-right-auto">
            <small>
                <a href="https://www.openstreetmap.org/?mlat={{ $gallery->latitude }}&amp;mlon={{ $gallery->longitude }}#map=19/{{ $gallery->latitude }}/{{ $gallery->longitude }}">
                    {{ __('Bigger map') }}
                </a>
            </small><br/>
            <div id="osm-map" class="osm-embed"></div>
        </div>

        <script nonce="{{ csp_nonce() }}">
            const map = L.map('osm-map', {
                scrollWheelZoom: false,
                center: [{{ $gallery->latitude }}, {{ $gallery->longitude }}],
                zoom: 9
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
            const marker1 = L.marker([{{ $gallery->latitude }}, {{ $gallery->longitude }}]).addTo(map);
        </script>


        <hr class="divider">


        <h3 class="fs-16 medium uppercase text-gray-60">{{ __('Tags:') }}</h3>
        <div class="flex flex-row flex-wrap">
            @foreach($gallery->tags as $tag)
                <a href="{{ route('public.tag', [$user->userHandle, $tag->slug]) }}" class=" fs-14">#{{ $tag->name }}</a>
            @endforeach
        </div>


    </div>
@endsection
