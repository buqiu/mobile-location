<?php

declare(strict_types=1);

namespace Buqiu\MobileLocation;

use Illuminate\Support\Str;

class LocationService
{
    /**
     * @throws \Exception
     */
    public static function mobile(string $phoneNumber): array
    {
        // 先使用第三方服务
        $thirdLocationData = ThirdMobileLocationService::analysisPhoneNumberLocation(phoneNumber: $phoneNumber);
        if (!empty($thirdLocationData)) {
            return self::_parseData($thirdLocationData);
        }

        // 再使用阿里云服务
        return self::_parseData(data: AliMobileLocationService::analysisPhoneNumberLocation(phoneNumber: $phoneNumber), isFromAli: true);
    }

    private static function _parseData(array $data, bool $isFromAli = false): array
    {
        return [
            'Service' => $isFromAli ? 'ali' : 'third',
            'Company' => $isFromAli ? $data['Carrier'] : (Str::length($data['company']) < 4 ? '中国'.$data['company'] : $data['company']),
            'Province' => $isFromAli ? $data['Province'] : $data['province'],
            'City' => $isFromAli ? $data['City'] : $data['city']
        ];
    }
}