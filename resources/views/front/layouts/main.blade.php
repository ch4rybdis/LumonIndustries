<!doctype html>
<html lang="en" data-bs-theme="auto">
@include('front.layouts.partials.head')

<body>
    @include('front.layouts.partials.mode')
    @include('front.layouts.partials.nav')

    @include('front.layouts.partials.sidebar')
    @yield('content')

    @include('front.layouts.partials.scripts')
</body>

</html>
