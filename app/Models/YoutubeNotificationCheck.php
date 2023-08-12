<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeNotificationCheck extends Model
{
    use HasFactory;

    protected $table = 'youtube_notification_check';

    protected $fillable = [
        'url',
        'youtube_notification_id',
    ];

}
