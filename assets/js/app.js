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
    $(".invite-link").attr("href", ok.instant_invite);
    var bot_list = [
      "Maki",
      "Pancake",
      "ProBot ✨",
      "[t!] Tatsumaki",
      "[!] SlugBot",
      "[,] Shinobu",
      "[?] Dyno",
      "[s/] ServerStats",
      "Jockie Music (3)",
    ];

    var status_user_list = {
      online: "text-success",
      idle: "text-warning",
      dnd: "text-danger",
    };

    // daftar channel
    $.each(ok.channels, function (key, value) {
      $(".list-group").append(
        '<li class="list-group-item text-start"> <i class="fa fa-volume-up" aria-hidden="true"></i> ' +
          value.name +
          '<span id="' +
          value.id +
          '"></span>' +
          "</li>"
      );
    });

    // var obj = jQuery.parseJSON(response);
    $.each(ok.members, function (key, value) {
      // script untuk tooltip
      var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
      );
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      if (bot_list.includes(value.username)) {
        $("#bot_list").append(
          $("#daftar_user_discord_onlen_bot")
            .html()
            .replace(/%src_gambar%/g, value.avatar_url)
            .replace(/%nama_user%/g, value.username)
        );
      }

      if (!bot_list.includes(value.username)) {
        // check apakah user sedang main game
        if (JSON.stringify(value).includes("game")) {
          $("#user_list_game").append(
            $("#daftar_user_discord_onlen_in_game")
              .html()
              .replace(/%src_gambar%/g, value.avatar_url)
              .replace(/%nama_user%/g, value.username)
              .replace(/%nama_game%/g, value.game.name)
              .replace(/%status_user%/g, status_user_list[value.status])
          );
        } else {
          $("#user_list").append(
            $("#daftar_user_discord_onlen")
              .html()
              .replace(/%src_gambar%/g, value.avatar_url)
              .replace(/%nama_user%/g, value.username)
              .replace(/%status_user%/g, status_user_list[value.status])
          );
        }
      }

      // kondisi ketika ada user yg nimbrung di dalam voice channel
      if (JSON.stringify(value).includes("channel_id")) {
        const tooltipTriggerList = document.querySelectorAll(
          '[data-bs-toggle="tooltip"]'
        );
        const tooltipList = [...tooltipTriggerList].map(
          (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );

        $("#" + value.channel_id).append(
          '<br><span style="margin-left: 1em;" id="listener-' +
            value.id +
            '"> <img class="rounded-circle" width="30px" height="30px" src="' +
            value.avatar_url +
            '">  ' +
            value.username +
            "</span>"
        );
        if (value.self_mute) {
          $("#listener-" + value.id).append(
            '<i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lagi matiin mic" style="margin-left:1em;" class="fa fa-microphone-slash text-danger" aria-hidden="true"></i>'
          );
        }
        if (value.self_deaf) {
          $("#listener-" + value.id).append(
            '<i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lagi matiin headset" style="margin-left:1em;" class="fa fa-deaf text-danger" aria-hidden="true"></i>'
          );
        }
      }
    });

    // // $('#loading').hide();
    // $('#oke').html(ok);
  },
});

$(document).ready(function () {
  $("#load_souls_news").load("/components/souls_news.html");
});
