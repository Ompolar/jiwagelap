<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeNotification extends Model
{
    use HasFactory;

    protected $table = 'youtube_notifications';


    protected $fillable = [
        'name',
        'channel_id',
        'description',
        'webhook_url',
        'template_post'
    ];

}
