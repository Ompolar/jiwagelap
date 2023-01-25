<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>



@include('layouts.components.head')






</head>
<body>
    <div id="app">


@include('layouts.components.top_navbar')



    <div class="container">


      <div class="row">
        <div class="col-12">
          <h1 class="text-light">
            Selamat Datang Di
            <span class="server-title text-warning ntaps"></span> Server
          </h1>




          <hr />
        </div>
      </div>


        <main class="py-4">
            <div class="row">

                @yield('content')
            </div>
        </main>
    </div>



</body>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

  <!-- Bootstrap JavaScript -->

  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" ></script>

  <script src="/my_assets/js/app.js?v=0.8"></script>


<script type="text/javascript">
  ScrollReveal().reveal('.ntaps', { delay: 1000 });
</script>


</html>
