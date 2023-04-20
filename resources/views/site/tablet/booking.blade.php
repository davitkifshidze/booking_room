@extends('site.layouts.main_template')

@section('title','Home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/tablet/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/mobiscroll/css/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('assets/plugins/mobiscroll/js/mobiscroll.javascript.min.js') }}"></script>

@endsection

@section('script')
    <script src="{{ asset('js/site/tablet/booking.js') }}"></script>
@endsection

@section('content')

    <div class="tablet__booking__container">

        <div class="form__container">

            <div class="form__header">
                <a class="back__btn" href="{{ route('tablet') }}">უკან დაბრუნება</a>
            </div>

            <form action="{{ route('tablet_booking') }}" id="room_booking_form" class="booking__form">
                @csrf
                @method('POST')

                <input type="hidden" name="room_id" id="room_id" value="{{ $room_id }}">

                <input type="hidden" name="personal_number" id="personal_number" value="">
                <input type="hidden" name="user_id" id="user_id" value="">

                <div class="start__booking">აირჩიე ჯავშნის პერიოდი</div>

                <div>
                    <div id="booking__calendar" class="booking-datetime"></div>
                </div>

                <div class="form__buttons">
                    <input class="booking__btn" id="booking__btn" type="submit" value="დაჯავშნა">
                </div>

            </form>

        </div>


        <div id="hidden__modal" class="hidden__modal" style="display: none;">

            <div class="close__container">
                <span id="close" class="close">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>

            <form id="user__form">
                @csrf
                <div class="modal__input__group">
                    <label for="number">პირადი ნომერი</label>
                    <input type="text" id="number" name="personal_number">
                </div>

                <div class="modal__input__group">
                    <label for="password">პაროლი</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="booking__error" id="booking__error"></div>

                <div class="btn__container">
                    <input class="check__user__btn" type="submit" value="ავტორიზაცია" >
                </div>
            </form>
        </div>


    </div>



@endsection


