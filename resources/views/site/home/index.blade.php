@extends('site.layouts.main_template')

@section('title','Home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/home/index.css') }}">


@endsection

@section('script')

@endsection

@section('content')


    <div class="home__container">

        <div class="user__container">
            <a href="{{ route('user_login_show') }}">
                მომხმარებელის ინტერფეისი
            </a>
        </div>

        <div class="room__container">
            <a href="{{ route('tablet') }}">
                პლანშეტის ინტერფეისი
            </a>
        </div>

        <div class="admin__container">
            <a href="{{ route('admin_login_show') }}">
                ადმინისტრატორის ინტერფეისი
            </a>
        </div>

    </div>


@endsection




