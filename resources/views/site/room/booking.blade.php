@extends('site.layouts.main_template')

@section('title','Home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/room/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/mobiscroll/css/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('assets/plugins/mobiscroll/js/mobiscroll.javascript.min.js') }}"></script>

@endsection

@section('script')
    <script src="{{ asset('js/site/room/booking.js') }}"></script>
@endsection

@section('content')

    <form action="" id="room_booking_form" class="booking__form">

        @csrf

        <input type="hidden" name="room_id" id="room_id" value="{{ $room_id }}">

        <div id="start__booking">დაიწყე დაჯავშნა</div>


        <div>
            <div id="booking__calendar" class="booking-datetime"></div>
        </div>

        <div class="form__buttons">
            <input class="modal__btn" type="submit">
        </div>

    </form>

@endsection


