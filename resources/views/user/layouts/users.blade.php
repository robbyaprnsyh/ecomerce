<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('user.layouts.components.top')

</head>

<body class="stretched">
    @include('admin.layouts.components.alert')
    <div id="wrapper" class="clearfix">
        {{-- Navbar --}}
        @include('user.layouts.components.navbar')

        <!-- Content-->
        <section id="content">
            <div class="content-wrap">
                @yield('content')
            </div>
        </section>

        <!-- Footer-->
        @include('user.layouts.components.footer')
    </div>
    @include('user.layouts.components.bottom')
    @stack("script")
</body>
</html>