<?php

namespace App\Services;

use Ably\AblyRest;

class AblyService
{
    protected $ably;

    public function __construct()
    {
        // dd(env('ABLY_API_KEY'));
        $this->ably = new AblyRest('V7o31w.07nOFw:ZNQp5CvPisYmMX6e3lati0F5OAc1bBV15RRmShduSHI');
        // $this->ably = new AblyRest(env('ABLY_API_KEY'));
    }

    public function publishMessage($channelName, $eventName, $data)
    {
        $channel = $this->ably->channel($channelName);
        $channel->publish($eventName, $data);
    }
}
