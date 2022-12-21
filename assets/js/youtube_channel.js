// daftar channel ID warga jiwa gelap
const channel_id_youtube_list = {'Reka': 'UCeF7_Y1UhBCkZ56pb-Z-ASA'};

$.each(channel_id_youtube_list, function (key_channel, value_channel) {
        $('#user_list').append('<h1>'+key_channel+'</h1> <hr> <div class="d-flex flex-wrap" id="yutub_vidio_list-'+value_channel+'"></div>')



    form_data = {};
    $.ajax({
      url: "https://api.rss2json.com/v1/api.json?rss_url=https://www.youtube.com/feeds/videos.xml?channel_id="+value_channel,
      type: "GET",
      data: form_data,
      error: function (err) {
        $("#loading").hide();
        swal("Oops, something went wrong!", null, "error");
      },
      success: function (ok) {

        var no = 1;
        $.each(ok.items, function (key, value) {
            console.log(value);
            if(no <= 4){
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


                $('#yutub_vidio_list-'+value_channel).append(
                    $('#template_youtube_channel').html()
                    .replace(/%tumbnail%/g, value.thumbnail)
                    .replace(/%judul%/g, value.title)
                    .replace(/%url%/g, value.link)
                    .replace(/%published%/g, moment(value.pubDate, "YYYYMMDD").fromNow())
                    .replace(/%tgl_tooltip%/g, value.pubDate)

                );

            }
            no++;
        });
      },
    });
});





    form_data = {};
    $.ajax({
      url: "https://discord.com/api/guilds/604606442393042945/widget.json",
      type: "GET",
      data: form_data,
      error: function (err) {
        $("#loading").hide();
        swal("Oops, something went wrong!", null, "error");
      },
      success: function (ok) {
        // let data = JSON.parse(ok);
        document.title = ok.name;
        $(".server-title").html(ok.name);

      },
    });