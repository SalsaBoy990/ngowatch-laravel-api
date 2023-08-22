@extends('layouts.profile')

@section('header')
    <x-public.header-profile :handler="$user->userHandle" :userId="$user->id"></x-public.header-profile>
@endsection

@section('content')

    <div class="content-600 public-account">

        <div class="flex flex-row margin-bottom-1" style="align-items: center;">
            <img src="{{ asset($user->user_detail->avatar) }}"
                 alt="{{ $user->name }}" class="circle margin-right-1 profile">
            <h1 class="margin-top-bottom-0">{{ $user->name }}</h1>
        </div>

        <p>{{  $user->user_detail->bio }}</p>

        @auth
            @if($user->id === Auth()->id())
                <div class="bar three margin-bottom-1-5">
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

        <div class="public-account--galleries-grid">
            @foreach($galleries as $gallery)

                <article class="card round">
                    <a href="{{ route('public.gallery', [$user->userHandle, $gallery->slug]) }}">
                        <div class="relative margin-bottom-0-5">
                            <img src="{{ asset($gallery->thumbnail_image) }}" alt="{{ $gallery->title }}"
                                 class="hover-opacity round-top">
                            <div
                                class="badge gray-60 fs-14 semibold absolute topleft margin-left-0-5 margin-top-0-5">
                                {{ $gallery->start . ' - ' . $gallery->end }}
                            </div>
                        </div>
                    </a>
                    <div class="padding-right-left-1 padding-top-bottom-0-5">
                        <h2 class="h3 margin-top-0 margin-bottom-0-5"><a
                                href="{{ route('public.gallery', [$user->userHandle, $gallery->slug]) }}">{{ $gallery->title }}</a></h2>
                        <address class="fs-20">{{ $gallery->location }}</address>
                    </div>
                </article>
            @endforeach
        </div>
        @if (isset($galleries))
            {{ $galleries->links('components.global.pagination') }}
        @endif
    </div>

@endsection
