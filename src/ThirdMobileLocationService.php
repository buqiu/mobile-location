<?php

declare(strict_types=1);

namespace Buqiu\MobileLocation;

use Buqiu\MobileLocation\Enum\ThirdMobileLocationCode;
use Illuminate\Support\Facades\Http;

class ThirdMobileLocationService
{
    protected static string $api = 'https://plocn.market.alicloudapi.com/plocn';

    /**
     * @param string $phoneNumber
     * @return array
     * @throws \Exception
     */
    public static function analysisPhoneNumberLocation(string $phoneNumber): array
    {
        try {
            $response = Http::withHeaders(['Authorization' => 'APPCODE '.config('location.third.app_code')])->withoutVerifying()->get(self::$api, ['n' => $phoneNumber]);
            if (!$response->successful()) {
                throw new \Exception(ThirdMobileLocationCode::from('UNKNOWN')->label());
            }

            $responseData = $response->json();
            if (empty($responseData)) {
                return [];
            }

            $code = $responseData['code'];
            if (ThirdMobileLocationCode::SUCCESS->value != $code) {
                throw new \Exception(ThirdMobileLocationCode::from($code)->label());
            }

            return $responseData;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
