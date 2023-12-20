<?php

declare(strict_types=1);

namespace Buqiu\MobileLocation\Enum;

enum AliMobileLocationCode: string
{
    case OK = 'OK';

    case INVALID_PARAMETER = 'InvalidParameter';

    case PHONE_NUMBER_NOTFOUND = 'PhoneNumberNotfound';

    case UNKNOWN = 'isp.UNKNOWN';

    case REQUEST_FREQUENCY_LIMIT = 'RequestFrequencyLimit';

    public function label(): string
    {
        return match ($this) {
            self::OK                      => '成功',
            self::INVALID_PARAMETER       => '传入的手机号错误或参数格式错',
            self::PHONE_NUMBER_NOTFOUND   => '传入的手机号查不到归属结果',
            self::UNKNOWN                 => '未知异常',
            self::REQUEST_FREQUENCY_LIMIT => '因运营商限制，禁止在短时间内高频对同一个号码进行反复查询，请您稍后再试',
        };
    }
}
