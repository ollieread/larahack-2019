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

    public static function messages(string $type = null)
    {
        if ($type) {
            return self::session()->get(sprintf('alerts.%s', $type), []);
        }

        return self::session()->get('alerts', []);
    }

    public static function message(string $type, string $message): void
    {
        self::session()->push(sprintf('alerts.%s', $type), $message);
    }

    public static function success(string $message): void
    {
        self::message(self::SUCCESS, $message);
    }

    public static function error(string $message): void
    {
        self::message(self::ERROR, $message);
    }

    public static function warning(string $message): void
    {
        self::message(self::WARNING, $message);
    }

    public static function info(string $message): void
    {
        self::message(self::INFO, $message);
    }

    /**
     * @return \Illuminate\Session\Store
     */
    private static function session(): Store
    {
        return Container::getInstance()->make(Store::class);
    }
}