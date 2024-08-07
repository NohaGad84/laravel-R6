



<!doctype html>
<html lang="en">
    @include('includes.head')
    
    <body>

    @include('includes.preloader')

        <main>

        @include('includes.navbar')

            @yield('content')

        

        @include('includes.footer')

        @yield('team')
        @include('includes.footerjs')


    </body>
</html>

