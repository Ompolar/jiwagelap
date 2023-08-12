@extends('layouts.app')


@section('content')



      <div class="row">
        <div class="col-12">

      <span class="navbar-text  text-ds pull-right mr-0">
        <a
          class="btn btn-info invite-link   display-1 text-black-50 "
          style="font-size: 30px;"
          class="discord--link"
          target="_blank"
          href="https://discord.gg/9kkx6PM"
          >Join Server Kami
        </a>
      </span>


          <h1 class="text-light fw-bold text-center text-ds">
            Selamat Datang Di
            <span class="server-title text-warning ntaps"></span> Server
          </h1>



          <hr />
        </div>
      </div>



        <div class="col-sm-3 custom-bg">


          <div class="channels text-ds">
            <div class="channels--header">
              <h2 class="text-light">Voice Channels :</h2>
            </div>
            <div class="channels--body">
              <ul class="list-group"></ul>
              <hr />
              <h3 class="text-light">NPC 's :</h3>

              <hr />
              <div class="d-flex flex-wrap" id="bot_list"></div>
            </div>
          </div>

          <div style="margin-top: 2em">
            <hr />
            <h3 class="text-light text-ds">Gim Gratisan</h3>
            <hr />
            <a
              class="twitter-timeline ntaps"
              data-height="800"
              data-theme="dark"
              href="https://twitter.com/GrabFreeGames"
              >Tweets by GrabFreeGames</a
            >
            <hr />

            <div class="  text-start" style="background: rgba(0, 0, 0, 0.3);">

              <h3 class="text-light text-ds" class="ntaps"> <i class="fa fa-book" aria-hidden="true"></i> Animu update</h3>
              <hr />
              <div id="load_animu_update"></div>
            </div>


          </div>
        </div>


        <div class="col-sm-9 custom-bg">



          <h2 class="font-family fw-bold text-light text-ds">Yang lagi main gim :</h2>
          <hr />
          <div
            class="d-flex flex-wrap"
            id="user_list_game"
            style="margin-bottom: 5em"
          ></div>
          <h2 class="text-light fw-bold text-ds">Yang lagi nyantai :</h2>
          <hr />
          <div class="d-flex flex-wrap" id="user_list"></div>
        </div>




    <script id="daftar_user_discord_onlen" type="text/template">
      <div class="col-sm-4 col-6">
        <div class="thumbnail ntaps">
        <img class="img-thumbnail borderds" width="200px" heigh="200px" src="%src_gambar%" alt="...">
        <div class="caption mt-1">

            <h3 class="text-light" class="fs-5 fw-semibold text-warning"> <i class="fa fa-circle %status_user%" aria-hidden="true"></i> %nama_user%</h3>
        </div>
        </div>
      </div>
    </script>

    <script id="daftar_user_discord_onlen_in_game" type="text/template">
      <div class="col-sm-3 col-6">
        <div class="thumbnail ntaps">
        <img class="img-thumbnail borderds" width="200px" heigh="200px" src="%src_gambar%" alt="...">
        <div class="caption mt-2 onleningame">
            <h3 class="text-light" class="fs-5">
            <i class="fa fa-circle %status_user%" aria-hidden="true"></i>  %nama_user%
          </h3>
            <p class="fw-semibold " style="color:#ccc;"> %nama_game%</p>
        </div>
        </div>
      </div>
    </script>

    <script id="daftar_user_discord_onlen_bot" type="text/template">
      <div class="col-3">
        <div class="thumbnail ntaps" style="height: 80px; width: 80px;">
        <img  data-bs-toggle="tooltip" data-bs-placement="top" title="%nama_user%"
        class="img-thumbnail " width="80px" heigh="80px" src="%src_gambar%" alt="..."
        >
        </div>
      </div>
    </script>

    <script id="animu_update_template" type="text/template">
        <a class="link-light ntaps" target="__blank" href="%animu_url%">   %judul%  </a>
        <br>
        <span data-bs-toggle="tooltip" data-bs-title="%tgl_tooltip%" class='text-muted'>%published%</span>
        <hr>
    </script>


<div class="col-12 custom-bg" style="margin-top: 2em">
  <h1>Souls News</h1>
  <hr />

  <!-- <rssapp-wall id="_cdXsZO3x26UyOEI0"></rssapp-wall><script src="https://widget.rss.app/v1/wall.js" type="text/javascript" async></script> -->
  <a
    class="twitter-timeline"
    data-theme="dark"
    href="https://twitter.com/fromsoftware_pr?ref_src=twsrc%5Etfw"
    >Tweets by fromsoftware_pr</a
  >
</div>

<script id="bot_list_json" type="application/json">
    {!! $bot_list !!}
</script>


@endsection




@section('script')
@vite('resources/js/my_app.js')
@endsection
