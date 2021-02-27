<!DOCTYPE html>
<html lang="en">
    <head>
        @include('website.layout.header')
    </head>
    <body id="page-top">

        @include('website.layout.navbar')


                @yield('body')

            
        @include('website.layout.footer')

    </body>
</html>