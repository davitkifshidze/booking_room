@extends('admin.layouts.main_template')

@section('title','Room')


@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/room/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/room/modal.css') }}">

@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/room/index.js') }}"></script>
    <script src="{{ asset('js/admin/room/modal.js') }}"></script>
@endsection

@section('content')

    <div class="room">
        <div class="page__header">
            <div class="page__title">
                <p>
                    შეხვედრების ოთახი
                </p>
            </div>
            <div class="new__room">
                <a href="javascript:void(0)" onclick="openModal('modal','create')">ახალი ოთახი</a>
            </div>

        </div>
        <div class="room__table__container">
            <div class="room__header">

            </div>
            <div class="table__container">
                <table class="room__table">
                    <thead>
                    <tr class="table__head">
                        <th>ოთახი</th>
                        <th>დაწყების თარიღი</th>
                        <th>დასრულების თარიღი</th>
                        <th>დამატების თარიღი</th>
                        <th>განახლების თარიღი</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table__body">

                    @foreach($rooms as $room)
                        <tr>
                            <td class="tbody__td">{{ $room->name }}</td>
                            <td class="tbody__td">{{ $room->start_date }}</td>
                            <td class="tbody__td">{{ $room->end_date }}</td>
                            <td class="tbody__td">{{ $room->created_at }}</td>
                            <td class="tbody__td">{{ $room->updated_at }}</td>
                            <td>
                                <a href="javascript:void(0)" class="edit__link" onclick="openModal('modal','edit',{{ $room->id }})">
                                    <i class="pen__icon fa-solid fa-pen"></i>
                                    <p>რედაქტირება</p>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="delete__link" data-id="{{ $room->id }}">
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

    @include('admin.room.modal')

@endsection
