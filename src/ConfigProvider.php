<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Humx\HyperfSms;

use Humx\HyperfSms\Contract\SmsInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                SmsInterface::class => SmsFactory::class
            ],
            'commands'     => [
            ],
            'annotations'  => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish'      => [
                [
                    'id'          => 'config',
                    'description' => 'The config for sms component.',
                    'source'      => __DIR__ . '/../publish/sms.php',
                    'destination' => BASE_PATH . '/config/autoload/sms.php',
                ],
            ],
        ];
    }
}
