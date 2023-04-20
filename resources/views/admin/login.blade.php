@extends('admin.layouts.login_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/login.js') }}"></script>
@endsection

@section('content')


    <div class="login__page">

        <div class="back__btn">
            <a href="{{ route('home') }}">მთავარი</a>
        </div>

        <div class="login__page__container">

            <div class="login__left__container">
            </div>

            <div class="login__container">

                <div class="login__form__header__container">
                    <img class="login__header__img" src="{{ asset('assets/images/logo/todua.svg') }}" alt="">
                </div>

                <div class="login__form__container">

                    {!! Form::open(["route" => "login", "method" => "POST"]) !!}
                    @csrf

                    <div class="login__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-regular fa-envelope"></i>
                            </div>
                            {!! Form::email('email', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'admin@gmail.com','id' => 'email', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="login__form__group">

                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-lock"></i>
                            </div>
                            {!! Form::password('password', ['class' => 'input__with__icon form__input', 'placeholder' => 'password_example', 'id' => 'password', 'required' => 'required']) !!}
                        </div>
                        <i class="fa-solid fa-eye-slash" id="eye" onclick="show_hide_password()"></i>
                    </div>


                    <div class="login__error__container">
                        @if(session()->has('wrong_fields'))
                            <p class="login__error">
                                {{ session('wrong_fields') }}
                            </p>
                        @endif
                    </div>

                    <div>
                       <p class="login__info">ადმინისტრატორის მონაცემები იხილეთ გიტზე</p>
                    </div>

                    <div class="login__form__group">
                        {!! Form::submit('ავტორიზაცია', ['class' => 'auth__btn', 'name' => 'auth', 'id' => 'auth']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>


    </div>

@endsection




