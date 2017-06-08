<?php
declare(strict_types=1);

namespace App\Utility;


class GetIp
{
    public static function getUserIpV4()
    {
        return static::getIp(FILTER_FLAG_IPV4);
    }

    public static function getUserIpV6()
    {
        return static::getIp(FILTER_FLAG_IPV6);
    }

    private static function getIp($filterFlagIpType)
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        $ip = null;

        if (filter_var($client, FILTER_VALIDATE_IP, $filterFlagIpType)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP, $filterFlagIpType)) {
            $ip = $forward;
        } elseif (filter_var($remote, FILTER_VALIDATE_IP, $filterFlagIpType)) {
            $ip = $remote;
        }

        return $ip;
    }
}