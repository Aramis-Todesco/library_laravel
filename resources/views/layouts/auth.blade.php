<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.components.head')

</head>

<body>
    @include('layouts.components.header')

    <main id="main-container">

        <div class="container mt-2">
            <div class="row">
                @yield('title')
            </div>

        </div>

        <div class="container mt-2 border border-primary">

            @yield('content')

        </div>

    </main>

    @include('layouts.components.js')


</body>

</html>
