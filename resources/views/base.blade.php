<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        @include('includes.head')
    </head>
    <body>
        @include(includes.navbar)
        <main id="main-content">
            @yield('content')
        </main>
        <footer>
            @include(includes.footer)
        </footer>
    </body> 
</html>