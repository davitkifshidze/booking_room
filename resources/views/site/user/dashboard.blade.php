@extends('site.user.layouts.user_template')

@section('title','Dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/user/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/user/dashboard.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/site/user/main.js') }}"></script>
@endsection

@section('content')

    <div class="dashboard">

        <div class="title">
            <p>მომხმარებელის დაფა</p>
        </div>

        <div class="card__container">

            <div class="dash__card">
                <div class="icon__container bookings__card">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card__info">
                    <p class="info__number">{{ $user_booking }}</p>
                    <p class="info__title">ჯავშნები</p>
                </div>
            </div>

        </div>

    </div>

@endsection




