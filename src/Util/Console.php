<?php

namespace Jetimob\Juno\Util;

class Console
{
    public static function log($msg, ...$args): void
    {
        if (count($args) > 0) {
            $msg = sprintf($msg, ...$args);
        }

        if (is_null($msg)) {
            $msg = 'NULL';
        }

        $encode = static fn () => json_encode($msg, JSON_PRETTY_PRINT);

        if (is_array($msg)) {
            $msg = $encode();
        } elseif (is_object($msg)) {
            if (method_exists($msg, '__toString')) {
                $msg = $msg->__toString();
            } else {
                $msg = $encode();
            }
        }

        fwrite(STDERR, self::format($msg));
    }

    private static function format(string $msg): string
    {
        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $callee = $stack[1];

        return sprintf(
            '[DEBUG]: %s%s[%s:%d]%s%s',
            $msg,
            PHP_EOL,
            $callee['file'],
            $callee['line'],
            PHP_EOL,
            PHP_EOL
        );
    }
}
