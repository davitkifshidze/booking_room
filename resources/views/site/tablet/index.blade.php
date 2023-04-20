@extends('site.layouts.main_template')

@section('title','Home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/tablet/index.css') }}">


@endsection

@section('script')

@endsection

@section('content')


    <div class="home__container">
        <div class="room__container">

            @foreach($rooms as $key => $room)
                <a href="{{ 'room/' . $room->id }}" class="room">
                    {{ $room->name }}
                </a>
            @endforeach()

        </div>
    </div>

@endsection




