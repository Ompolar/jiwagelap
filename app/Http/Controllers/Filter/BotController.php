<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index()
    {
        $bots = Bot::all();
        return view('bot', compact('bots'));
    }


    public function insert()
    {
        $this->validate(request(),[
            'bot_name'   => 'required',
        ]);
        $data = request()->except('_token');
        $insert = Bot::create($data);
        return $insert;
    }

    public function delete()
    {
        $get = Bot::find(request()->id);
        $delete = $get->delete();
        return $delete;
    }


}

