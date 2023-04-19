<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--  Font Awesome 6.3.0  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

    {{--  Jquery CDN  --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{--  Bootstrap CDN  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{--    Sweet Alert    --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Custom Style -->
    @yield('style')

</head>
<body>


<div class="user__interface__template" id="page__template">

    @include('site.user.layouts.include.sidebar')

    <div class="main__container">

        @include('site.user.layouts.include.header')

        <main class="main__content">
            @yield('content')
        </main>

    </div>
</div>


<!-- Custom Js -->
@yield('script')

</body>
</html>
