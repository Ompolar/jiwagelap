<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ChannelController extends Controller
{
    public function index()
    {
        return view('youtube_channel');
    }
}
