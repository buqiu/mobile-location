# mobile-location

## 介绍
号码归属地查询，只支持（中国移动、中国电信、中国联通、中国广电）运营商

## 环境
```
php >= 8.1
composer >= 2.0
```

## 使用

#### 1.安装
```
composer require buqiu/mobile-location
```
#### 2.发布 location.php 配置文件
```
php artisan vendor:publish --tag=location
```
#### 3.在 config\app.php 找到 aliaes 数组，添加刚创建的类
```
'Location' =>   Buqiu\MobileLocation\Facades\LocationFacade::class
```
#### 3.配置 .env 文件
```
# 阿里云账号
ALIBABA_CLOUD_ACCESS_KEY_ID=
ALIBABA_CLOUD_ACCESS_KEY_SECRET=

# 号码百科
ALI_MOBILE_LOCATION_AUTH_CODE=

# 第三方号码归属地服务
THIRD_MOBILE_LOCATION_APP_CODE=
```

## 示例代码
```php
use Location;

Location::mobile('13100000000');
```

## 返回值
```php
[
    'Service' => '服务商[ali:阿里云,third:第三方]',
    'Company' => '号码当前归属运营商',
    'Province' => '省份',
    'City' => '城市'
]
```