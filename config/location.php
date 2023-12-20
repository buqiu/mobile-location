<?php

declare(strict_types=1);

return [
    // 阿里云-号码百科服务
    'ali' => [
        'access_key_id'     => env('ALIBABA_CLOUD_ACCESS_KEY_ID'),
        'access_key_secret' => env('ALIBABA_CLOUD_ACCESS_KEY_SECRET'),

        // 号码归属地查询端点
        'mobile_location' => [
            'endpoint'  => env('ALI_MOBILE_LOCATION_ENDPOINT', 'dytnsapi.aliyuncs.com'),
            'auth_code' => env('ALI_MOBILE_LOCATION_AUTH_CODE'),
        ],
    ],

    // 阿里云-第三方号码归属地查询服务
    'third' => [
        'app_code' => env('THIRD_MOBILE_LOCATION_APP_CODE'),
    ],
];