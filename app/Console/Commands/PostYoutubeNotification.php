<?php

namespace App\Console\Commands;

use App\LibrarySaya\FungsiYoutube;
use App\Models\YoutubeNotification;
use App\Models\YoutubeNotificationCheck;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PostYoutubeNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jiwagelap:post_youtube_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'post notif youtube ke berbagai channel atau pun server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all_yt_notifications = YoutubeNotification::all();
        $fungsi_youtube = new FungsiYoutube;
        foreach($all_yt_notifications as $list){
            $fungsi_youtube->sendToDiscordChannel($list->id);
        } // endforeach

        return Command::SUCCESS;
    }
}
