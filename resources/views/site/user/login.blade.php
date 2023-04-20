@extends('site.user.layouts.login_register_template')

@section('title','User Login')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/user/login.css') }}">


@endsection

@section('script')
    <script src="{{ asset('js/site/user/login.js') }}"></script>

@endsection

@section('content')


    <div class="login__page">


        <div class="back__btn">
            <a href="{{ route('home') }}">მთავარი</a>
        </div>

        <div class="registration__btn">
            <a href="{{ route('user_registration_show') }}">რეგისტრაცია</a>
        </div>


        <div class="login__page__container">

            <div class="login__left__container">
            </div>

            <div class="login__container">

                <div class="login__form__header__container">
                    <img class="login__header__img" src="{{ asset('assets/images/logo/todua.svg') }}" alt="">
                </div>

                <div class="login__form__container">

                    {!! Form::open(["route" => "user_login", "method" => "POST"]) !!}
                    @csrf

                    <div class="login__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-person"></i>
                            </div>
                            {!! Form::text('personal_number', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'პირადი ნომერი','id' => 'personal_number', 'required' => 'required']) !!}
                        </div>
                    </div>

                    <div class="login__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-lock"></i>
                            </div>
                            {!! Form::password('password', ['class' => 'input__with__icon form__input', 'placeholder' => 'პაროლი', 'id' => 'password', 'required' => 'required']) !!}
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

                    <div class="login__form__group">
                        {!! Form::submit('ავტორიზაცია', ['class' => 'auth__btn', 'name' => 'auth', 'id' => 'auth']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>


    </div>



@endsection




