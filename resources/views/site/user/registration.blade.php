@extends('site.user.layouts.login_register_template')

@section('title','User Registration')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/site/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/site/user/registration.css') }}">

@endsection

@section('script')
    <script src="{{ asset('js/site/user/registration.js') }}"></script>

@endsection

@section('content')


    <div class="registration__page">

        <div class="back__btn">
            <a href="{{ route('home') }}">მთავარი</a>
        </div>

        <div class="login__btn">
            <a href="{{ route('user_login_show') }}">ავტორიზაცია</a>
        </div>


        <div class="registration__page__container">

            <div class="registration__left__container">
            </div>

            <div class="registration__container">

                <div class="registration__form__header__container">
                    <img class="registration__header__img" src="{{ asset('assets/images/logo/todua.svg') }}" alt="">
                </div>

                <div class="registration__form__container">

                    {!! Form::open(["route" => "user_register", "method" => "POST"]) !!}
                    @csrf

                    <div class="registration__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-signature"></i>
                            </div>
                            {!! Form::text('name', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'სახელი','id' => 'name', 'required' => 'required']) !!}
                        </div>
                        @error('name')
                            <div class="input__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="registration__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-file-signature"></i>
                            </div>
                            {!! Form::text('surname', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'გვარი','id' => 'surname', 'required' => 'required']) !!}
                        </div>
                        @error('surname')
                            <div class="input__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="registration__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-person"></i>
                            </div>
                            {!! Form::text('personal_number', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'პირადი ნომერი','id' => 'personal_number', 'required' => 'required']) !!}
                        </div>
                        @error('personal_number')
                            <div class="input__error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="registration__form__group">
                        <div class="password__container">
                            <div class="input__with__icon__container">
                                <div class="input__icon__container">
                                    <i class="input__icon fa-solid fa-lock"></i>
                                </div>
                                {!! Form::password('password', ['class' => 'input__with__icon form__input', 'placeholder' => 'პაროლი', 'id' => 'password', 'required' => 'required']) !!}
                            </div>
                            <i class="fa-solid fa-eye-slash" id="eye" onclick="show_hide_password()"></i>
                        </div>
                        @error('password')
                            <div class="input__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="registration__error__container">
                        @if(session()->has('wrong_fields'))
                            <p class="registration__error">
                                {{ session('wrong_fields') }}
                            </p>
                        @endif
                    </div>

                    <div class="registration__form__group">
                        {!! Form::submit('რეგისტრაცია', ['class' => 'register__btn', 'name' => 'register', 'id' => 'register']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

    </div>

@endsection




