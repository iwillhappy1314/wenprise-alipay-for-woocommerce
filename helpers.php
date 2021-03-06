<?php

/**
 * 判断是否在微信中打开
 */
function wprs_wc_alipay_is_wechat()
{
    if ( ! empty($_SERVER[ 'HTTP_USER_AGENT' ]) && strpos($_SERVER[ 'HTTP_USER_AGENT' ], 'MicroMessenger') !== false) {
        return true;
    }

    return false;
}


/**
 * 获取用户的真实 IP
 *
 * @return mixed
 */
function wprs_wc_alipay_get_ip()
{
    if (isset($_SERVER[ "HTTP_CF_CONNECTING_IP" ])) {
        $_SERVER[ 'REMOTE_ADDR' ]    = $_SERVER[ "HTTP_CF_CONNECTING_IP" ];
        $_SERVER[ 'HTTP_CLIENT_IP' ] = $_SERVER[ "HTTP_CF_CONNECTING_IP" ];
    }

    $client  = @$_SERVER[ 'HTTP_CLIENT_IP' ];
    $forward = @$_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
    $remote  = $_SERVER[ 'REMOTE_ADDR' ];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
