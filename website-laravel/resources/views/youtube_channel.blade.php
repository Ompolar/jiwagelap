@extends('layouts.app')

@section('content')
      <div class="row">
        <div class="col-sm-12 custom-bg">
          <div id="load_navbar"></div>
          <h2 class="font-family fw-bold text-start mt-3">warga yutuber :</h2>

          <div class="row" id="user_list"></div>
        </div>
      </div>
    </div>

    <!-- etc -->
    <script type="text/template" id="template_youtube_channel">
      <div class="card borderds" style="width: 18rem; margin-left:2em; background-color:black;">

        <img src="%tumbnail%" class="card-img-top ntaps" alt="...">

        <div class="card-body ">
        <p data-bs-toggle="tooltip" data-bs-title="%tgl_tooltip%" class='text-muted'>published : %published%</p>
          <h5 class="card-title text-success">

          <a href="%url%" target="__blank"> %judul%</a>

          </h5>
        </div>

      </div>

@endsection
@section('script')
@vite('resources/js/youtube_channel.js')
@endsection


