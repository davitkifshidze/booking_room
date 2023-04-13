@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
@endsection

@section('content')

    <div class="dashboard">

        <div class="title">
            <p>დაფა</p>
        </div>

        <div class="card__container">

            <div class="dash__card">
                <div class="icon__container news__card">
                    <i class="fa-regular fa-hospital"></i>
                </div>
                <div class="card__info">
                    <p class="info__number">1020</p>
                    <p class="info__title">ოთახები</p>
                </div>
            </div>
            <div class="dash__card">
                <div class="icon__container visitor__card">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card__info">
                    <p class="info__number">2834</p>
                    <p class="info__title">მომხმარებლები</p>
                </div>
            </div>

        </div>

    </div>


@endsection




