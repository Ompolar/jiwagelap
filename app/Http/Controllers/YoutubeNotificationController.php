<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\LibrarySaya\FungsiYoutube;
use App\Models\YoutubeNotification;
use App\Models\YoutubeNotificationCheck;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class YoutubeNotificationController extends Controller
{



    public function index()
    {
        $yt_notification = YoutubeNotification::all();
        return view('yt_notification', compact('yt_notification'));
    }


    public function insert()
    {
        $this->validate(request(),[
            'name'   => 'required',
            'channel_id'   => 'required',
            'description'   => 'required',
            'template_post'   => 'required',
            'webhook_url'   => 'required',
        ]);
        $data = request()->except('_token');
        $insert = YoutubeNotification::create($data);
        return $insert;
    }

    public function delete()
    {
        $get = YoutubeNotification::find(request()->id);
        $delete = $get->delete();
        return $delete;
    }


    public function send()
    {
        $fungsi_youtube = new FungsiYoutube;
        $job = $fungsi_youtube->sendToDiscordChannel(request()->id);
        return $job;
    }


}

