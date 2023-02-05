<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>



@include('layouts.components.head')






</head>
<body>
    <div id="app">


@include('layouts.components.top_navbar')

    <div class="container">

        <main class="py-4">
            <div class="row">

                @yield('content')
            </div>
        </main>
    </div>



</body>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" ></script>

@vite('resources/js/app.js')

<script type="text/javascript">
  ScrollReveal().reveal('.ntaps', { delay: 1000 });
</script>


@yield('script')


</html>
