<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>Himalayas</title>
        @include('layouts.head')
    </head>
    <body>
      <!-- header -->
        <header id="home">
            @include('layouts.header')
        </header>
        @yield('content')
      
      <footer>
        @include('layouts.footer')
      </footer>
   </body>
</html>