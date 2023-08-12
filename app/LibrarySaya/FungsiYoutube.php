<?php
namespace App\LibrarySaya;

use App\Models\YoutubeNotification;
use App\Models\YoutubeNotificationCheck;
use GuzzleHttp\Client;

class FungsiYoutube
{


    /**
     * convert XML ke JSON dari url youtube yang berupa RSS Feed.
     * contoh URL : https://www.youtube.com/feeds/videos.xml?channel_id=UCeF7_Y1UhBCkZ56pb-Z-ASA
     * @param  [string] $url [description]
     * @return json
     */
    public function xmlToJSONFromURL($url)
    {
        $xmlString = file_get_contents($url);
        if ($xmlString === false) {
            return false; // Unable to fetch XML data
        }

        $xml = simplexml_load_string($xmlString);
        if ($xml === false) {
            return false; // Unable to parse XML
        }

        $videos = [];
        foreach ($xml->entry as $entry) {
            $video = [
                'title' => (string)$entry->title,
                'link' => (string)$entry->link['href'],
                'published' => (string)$entry->published,
                'description' => (string)$entry->children('media', true)->group->description,
                'thumbnail' => (string)$entry->children('media', true)->group->thumbnail->attributes()['url'],
            ];
            $videos[] = $video;
        }

        $json = json_encode($videos, JSON_PRETTY_PRINT);
        return $json;
    }


    // public function ok()
    // {
    //     $url = "https://www.youtube.com/feeds/videos.xml?channel_id=UCeF7_Y1UhBCkZ56pb-Z-ASA";
    //     $jsonResult = $this->xmlToJSONFromURL($url);

    //     if ($jsonResult !== false) {
    //         $firstVideo = $this->getFirstVideoFromJSON($jsonResult);
    //         if ($firstVideo !== false) {
    //             print_r($firstVideo);
    //         } else {
    //             echo "No videos found.";
    //         }
    //     } else {
    //         echo "Error fetching or parsing XML data.";
    //     }

    // }


    /**
     * ambil record pertama dari hasil json sebuah channel.
     * @param  [type] $json [description]
     * @return array
     */
    public function getFirstVideoFromJSON($json)
    {
        $videos = json_decode($json, true);
        if (!$videos || empty($videos)) {
            return false; // Invalid JSON or no videos
        }

        $firstVideo = reset($videos); // Get the first video from the array

        return $firstVideo;
    }



    /**
     * mengambil channel ID dari youtube url
     * ada 2 macam url yang bisa diambil ID nya,
     * contoh youtube url yg bisa diambil : https://www.youtube.com/channel/UCeF7_Y1UhBCkZ56pb-Z-ASA, https://www.youtube.com/@rekaprihatanto
     * @param  [string] $youtubeUrl [description]
     * @return [array]             [array value pertama berupa boolean dan array kedua berupa ID atau keterangan jika terjadi error]
     */
    public function getChannelIdFromUrl($youtubeUrl) {
        try {
            $response = file_get_contents($youtubeUrl);
            if ($response !== false) {
                // Check for "/channel/" URL structure
                $pattern_channel = '/"channelId":"([^"]+)"/';
                if (preg_match($pattern_channel, $response, $matches_channel)) {
                    $channelId = $matches_channel[1];
                    return $channelId;
                }

                // Check for "/@username" URL structure
                $pattern_username = '/\/@([^\/?]+)/';
                if (preg_match($pattern_username, $youtubeUrl, $matches_username)) {
                    $username = $matches_username[1];
                    $apiUrl = "https://www.youtube.com/user/$username";
                    $apiResponse = file_get_contents($apiUrl);
                    $pattern_id = '/data-channel-external-id="([^"]+)"/';
                    if (preg_match($pattern_id, $apiResponse, $matches_id)) {
                        return [true, $matches_id[1]];
                    } else {
                        return [false, "Channel ID not found for username."];
                    }
                } else {
                    return [false, "URL structure not recognized."];
                }
            } else {
                return [false, "Failed to fetch the URL."];
            }
        } catch (Exception $e) {
            [false, "An error occurred: " . $e->getMessage()];
        }

        return [false, 'error'];
    }




    public function sendToDiscordChannel($youtube_notification_id)
    {
        $yt_notification = YoutubeNotification::findOrFail($youtube_notification_id);

        $client = new Client();
        $webhookUrl = $yt_notification->webhook_url;

        $youtube_url = 'https://www.youtube.com/feeds/videos.xml?channel_id='.$yt_notification->channel_id;

        $jsonResult = $this->xmlToJSONFromURL($youtube_url);

        $last_upload_url = '';
        $allow_post = false;
        if(($jsonResult !== false)){
            $firstVideo = $this->getFirstVideoFromJSON($jsonResult);
             if ($firstVideo !== false) {
                $last_upload_url = $firstVideo['link'];


                // untuk posting wajib memasukkan keyword #jiwagelap dan jiwagelap.my.id
                if (strpos($firstVideo['description'], '#jiwagelap') !== false && strpos($firstVideo['description'], 'jiwagelap.my.id') !== false) {
                    $allow_post = true;
                }

             }else{
                return false;
             }
        }



        $message = $yt_notification->template_post.', '.$last_upload_url;

        $check_url = YoutubeNotificationCheck::whereUrl($last_upload_url)->first();
        if(is_object($check_url)){
            // jika url sudah pernah dipost, maka diabaikan
            return false;
        }

        // jika tidak ada keyword di deskripsi, maka diabaikan
        if(!$allow_post){
            return false;
        }



        try {
            $response = $client->post($webhookUrl, ['json' => [
                'content' => $message,
                'username'  => 'Yt Notification'
            ]]);

            // Check the response status code if needed
            if ($response->getStatusCode() === 204) {
                YoutubeNotificationCheck::create(['url' => $last_upload_url, 'youtube_notification_id' => $yt_notification->id]);
                return true; // Successful post
            } else {
                return false; // Unsuccessful post
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error, invalid webhook)
            return false;
        }
    }



}
