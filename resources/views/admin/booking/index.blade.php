@extends('admin.layouts.main_template')

@section('title','Booking')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/booking/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/booking/modal.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/mobiscroll/css/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('assets/plugins/mobiscroll/js/mobiscroll.javascript.min.js') }}"></script>

@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/booking/index.js') }}"></script>
    <script src="{{ asset('js/admin/booking/modal.js') }}"></script>

@endsection

@section('content')

    <div class="booking">
        <div class="page__header">
            <div class="page__title">
                <p>
                    ჯავშნები
                </p>
            </div>
            <div class="new__booking">
                <a href="javascript:void(0)" onclick="openModal('modal','create')">ახალი ჯავშანი</a>
            </div>

        </div>
        <div class="booking__table__container">
            <div class="booking__header">

                <form action="{{ route('booking') }}" method="GET"  class="search__form" >

                    <select class="filter__select" name="room__filter" id="room__filter" placeholder="აირჩიე ოთახი">
                        <option value="">ყველა ოთახი</option>
                        @foreach($rooms as $key => $room)
                            <option value="{{ $room->id }}" {{ isset($room_id) && $room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>

                    <input class="filter__input" type="date" name="date__filter" value="{{ isset($date) ? $date : '' }}">

                    <input type="submit" value="ფილრაცია" class="filter__btn">

                </form>

            </div>
            <div class="table__container">
                <table class="booking__table">
                    <thead>
                    <tr class="table__head">
                        <th>ჯავშნის ID</th>
                        <th>ოთახი</th>
                        <th>მომხმარებელი</th>
                        <th>ჯავშნის დასაწყისი</th>
                        <th>ჯავშნის დასასრული</th>
                        <th>დამატების თარიღი</th>
                        <th>განახლების თარიღი</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table__body" id="booking_list">
                        @foreach($bookings as $key => $booking)
                            <tr>
                                <td class="tbody__td">{{ $booking->id }}</td>
                                <td class="tbody__td">{{ $booking->room_name }}</td>
                                <td class="tbody__td">{{ $booking->user_name }}</td>
                                <td class="tbody__td">{{ $booking->start_date }}</td>
                                <td class="tbody__td">{{ $booking->end_date }}</td>
                                <td class="tbody__td">{{ $booking->created_at }}</td>
                                <td class="tbody__td">{{ $booking->updated_at }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="delete__link" data-id="{{ $booking->id }}">
                                        <i class="delete__icon fa-solid fa-trash-can"></i>
                                        <p>წაშლა</p>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

    </div>

    @include('admin.booking.modal')

@endsection
