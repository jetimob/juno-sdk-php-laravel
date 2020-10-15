<?php

namespace Jetimob\Juno\Util;

class Log
{
    public static bool $enabled = true;

    /**
     * @param string $message
     * @param array $context
     * @param string $level
     */
    private static function fmt(string $message, array $context, string $level): void
    {
        if (!self::$enabled) {
            return;
        }

        $message = sprintf('[JUNO|%s]: %s', strtoupper(substr($level, 0, 3)), $message);
        \Illuminate\Support\Facades\Log::{$level}($message, $context);
    }

    /**
     * Logs a formatted message into Laravel's log facade to easily identify the message from this package.
     *
     * @param string $message
     * @param array $context
     */
    public static function error(string $message, array $context = []): void
    {
        self::fmt($message, $context, 'error');
    }

    /**
     * Logs a formatted message into Laravel's log facade to easily identify the message from this package.
     *
     * @param string $message
     * @param array $context
     */
    public static function warning(string $message, array $context = []): void
    {
        self::fmt($message, $context, 'warning');
    }

    /**
     * Logs a formatted message into Laravel's log facade to easily identify the message from this package.
     *
     * @param string $message
     * @param array $context
     */
    public static function info(string $message, array $context = []): void
    {
        self::fmt($message, $context, 'info');
    }

    /**
     * Logs a formatted message into Laravel's log facade to easily identify the message from this package.
     *
     * @param string $message
     * @param array $context
     */
    public static function debug(string $message, array $context = []): void
    {
        self::fmt($message, $context, 'debug');
    }
}
