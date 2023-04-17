@extends('admin.layouts.main_template')

@section('title','User')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/user/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/user/modal.css') }}">

@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/user/index.js') }}"></script>
    <script src="{{ asset('js/admin/user/modal.js') }}"></script>
@endsection

@section('content')

    <div class="user">
        <div class="page__header">
            <div class="page__title">
                <p>
                    მომხმარებლები
                </p>
            </div>
            <div class="new__user">
                <a href="javascript:void(0)" onclick="openModal('modal','create')">ახალი მომხმარებელი</a>
            </div>

        </div>
        <div class="user__table__container">
            <div class="user__header">

            </div>
            <div class="table__container">
                <table class="user__table">
                    <thead>
                        <tr class="table__head">
                            <th>სახელი</th>
                            <th>გვარი</th>
                            <th>პირადი ნომერი</th>
                            <th>დამატების თარიღი</th>
                            <th>განახლების თარიღი</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table__body">

                        @foreach($users as $user)
                            <tr>
                                <td class="tbody__td">{{ $user->name }}</td>
                                <td class="tbody__td">{{ $user->surname }}</td>
                                <td class="tbody__td">{{ $user->personal_number }}</td>
                                <td class="tbody__td">{{ $user->created_at }}</td>
                                <td class="tbody__td">{{ $user->updated_at }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="edit__link" onclick="openModal('modal','edit',{{ $user->id }})">
                                        <i class="pen__icon fa-solid fa-pen"></i>
                                        <p>რედაქტირება</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="delete__link" data-id="{{ $user->id }}">
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

    @include('admin.user.modal')

@endsection
