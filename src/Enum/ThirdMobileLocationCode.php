<?php

declare(strict_types=1);

namespace Buqiu\MobileLocation\Enum;

enum ThirdMobileLocationCode: string
{
    case SUCCESS = '1';

    case FAIL = '-1';

    case ERROR = '0';

    case UNKNOWN = 'UNKNOWN';

    public function label(): string
    {
        return match ($this) {
            self::SUCCESS => '成功',
            self::FAIL    => '传入的手机号查不到归属结果',
            self::ERROR   => '传入的手机号错误或参数格式错',
            self::UNKNOWN => '未知异常',
        };
    }
}
