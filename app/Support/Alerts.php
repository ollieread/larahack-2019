<?php

namespace Larahack\Support;

use Illuminate\Container\Container;
use Illuminate\Session\Store;

class Alerts
{
    public const SUCCESS = 'success';
    public const ERROR   = 'error';
    public const WARNING = 'warning';
    public const INFO    = 'info';

    public static function messages(string $type = null, string $context = 'default')
    {
        if ($type) {
            return self::session()->pull(sprintf('alerts.%s.%s', $context, $type), []);
        }

        return self::session()->pull(sprintf('alerts.%s', $context), []);
    }

    public static function message(string $type, string $message, string $context = 'default'): void
    {
        self::session()->push(sprintf('alerts.%s.%s', $context, $type), $message);
    }

    public static function success(string $message, string $context = 'default'): void
    {
        self::message(self::SUCCESS, $message, $context);
    }

    public static function error(string $message, string $context = 'default'): void
    {
        self::message(self::ERROR, $message, $context);
    }

    public static function warning(string $message, string $context = 'default'): void
    {
        self::message(self::WARNING, $message, $context);
    }

    public static function info(string $message, string $context = 'default'): void
    {
        self::message(self::INFO, $message, $context);
    }

    /**
     * @return \Illuminate\Session\Store
     */
    private static function session(): Store
    {
        return Container::getInstance()->make(Store::class);
    }
}