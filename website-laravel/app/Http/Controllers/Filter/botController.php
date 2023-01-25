<?php

namespace App\Http\Controllers\Filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BotController extends Controller
{
    public function index()
    {
        return view('bot');
    }
}

