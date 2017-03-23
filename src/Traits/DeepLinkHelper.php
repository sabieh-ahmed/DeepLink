<?php

namespace DeepLink\Common\Traits;

use Cloudinary;
use Illuminate\Support\Facades\Redis;

trait DeepLinkHelper
{
    /**
     * Send Notification to specific user.
     *
     * @param $user
     * @param $message
     * @param $title
     * @param array $data
     */
    public static function notify_user($user, $message, $title, $data = [])
    {
        $devices = $user->devices;
        if ($devices) {
            $tokens = [];
            foreach ($devices as $device) {
                $tokens[] = $device->device_token;
            }
            self::sendPush($message, $title, $tokens, $data);
        } else {
            return;
        }
    }

    /**
     * Generic function to send push notifications.
     *
     * @param $message
     * @param $title
     * @param array $tokens
     * @param array $data
     *
     * @return mixed
     */
    public static function sendPush($message, $title, $tokens = [], $data = [])
    {
        $content = [
            'en' => $message,
        ];
        $fields = [
            'app_id'             => config('deeplink.one_signal_app_id'),
            'include_player_ids' => $tokens,
            'data'               => $data,
            'contents'           => $content,
            'content_available'  => 1,
            'headings'           => ['en' => $title],
            'large_icon'         => 'icon',
            'small_icon'         => 'icon',
            'ios_badgeType'      => 'Increase',
            'ios_badgeCount'     => 1,
        ];
        $fields = json_encode($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.config('deeplink.one_signal_api_key')]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $arr = json_decode($response, true);

        return $response;
    }

    /**
     * Add device to user model.
     *
     * @param $user
     * @param $device_token
     *
     * @return mixed
     */
    public static function add_device($user, $device_token)
    {
        $devices = Device::where('device_token', $device_token)->get();
        foreach ($devices as $device) {
            $device->delete();
        }
        $new_device = Device::create(['device_token' => $device_token, 'user_id' => $user->id]);

        return $new_device;
    }

    /**
     * Upload files to cloudinary.
     *
     * @param $file
     *
     * @return mixed
     */
    public static function upload_file_cloudinary($file)
    {
        Cloudinary::config([
            'cloud_name' => config('deeplink.cloudinary_cloud_name'),
            'api_key'    => config('deeplink.cloudinary_api_key'),
            'api_secret' => config('deeplink.cloudinary_api_secret'),
        ]);
        $data = Cloudinary\Uploader::upload($file);

        return $data;
    }

    /**
     * Remove cloudinary Uploaded file.
     *
     * @param $file
     *
     * @return mixed
     */
    public static function remove_file_cloudinary($file)
    {
        Cloudinary::config([
            'cloud_name' => config('deeplink.cloudinary_cloud_name'),
            'api_key'    => config('deeplink.cloudinary_api_key'),
            'api_secret' => config('deeplink.cloudinary_api_secret'),
        ]);
        $data = Cloudinary\Uploader::destroy($file);

        return $data;
    }

    /**
     * Broadcast to redis client.
     *
     * @param $user
     * @param $event
     * @param $data_
     */
    public static function socketio_broadcast($user, $event, $data_)
    {
        $channel = 'user-global-'.$user->id;
        $data = [
            'event' => $event,
            'data'  => $data_,
        ];
        Redis::publish($channel, json_encode($data));
    }
}
