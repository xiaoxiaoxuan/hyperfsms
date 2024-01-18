<?php

declare(strict_types=1);
namespace Humx\HyperfSms\Gateways;

use Hyperf\Context\ApplicationContext;
use Hyperf\Logger\LoggerFactory;
use Overtrue\EasySms\Contracts\MessageInterface;
use Overtrue\EasySms\Contracts\PhoneNumberInterface;
use Overtrue\EasySms\Gateways\Gateway;
use Overtrue\EasySms\Support\Config;
use Psr\Log\LoggerInterface;

class LogGateway extends Gateway
{
    /**
     * The Logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->logger = ApplicationContext::getContainer()->get(LoggerFactory::class)->get(
            $config['name'] ?? 'sms',
            $config['group'] ?? 'default'
        );
    }

    /**
     * @param  \Overtrue\EasySms\Contracts\PhoneNumberInterface  $to
     * @param  \Overtrue\EasySms\Contracts\MessageInterface  $message
     * @param  \Overtrue\EasySms\Support\Config  $config
     *
     * @return array
     */
    public function send(PhoneNumberInterface $to, MessageInterface $message, Config $config)
    {
        $this->logger->info((string) $to, [
            'message'  => $message->getContent($this),
            'template' => $message->getTemplate($this),
            'data'     => json_encode($message->getData($this)),
        ]);

        return compact('message');
    }
}