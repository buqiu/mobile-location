<?php

declare(strict_types=1);

namespace Buqiu\MobileLocation;

use AlibabaCloud\SDK\Dytnsapi\V20200217\Dytnsapi;
use AlibabaCloud\SDK\Dytnsapi\V20200217\Models\DescribePhoneNumberOperatorAttributeRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Buqiu\MobileLocation\Enum\AliMobileLocationCode;
use Darabonba\OpenApi\Models\Config;

class AliMobileLocationService
{
    /**
     * @param string $phoneNumber
     * @return array
     * @throws \Exception
     */
    public static function analysisPhoneNumberLocation(string $phoneNumber): array
    {
        $client          = self::_createClient();
        $describeRequest = new DescribePhoneNumberOperatorAttributeRequest([
            'authCode'    => config('location.ali.mobile_location.auth_code'),
            'inputNumber' => $phoneNumber,
            'mask'        => 'NORMAL',
        ]);

        try {
            $response = $client->describePhoneNumberOperatorAttributeWithOptions($describeRequest, new RuntimeOptions([]));
            $code     = $response->body->code;
            if (AliMobileLocationCode::OK->value != $code) {
                throw new \Exception(AliMobileLocationCode::from($code)->label());
            }

            return $response->body->data->toMap();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private static function _createClient(): Dytnsapi
    {
        $config = new Config([
            'accessKeyId'     => config('location.ali.access_key_id'),
            'accessKeySecret' => config('location.ali.access_key_secret'),
        ]);
        $config->endpoint = config('location.ali.mobile_location.endpoint');

        return new Dytnsapi($config);
    }
}
