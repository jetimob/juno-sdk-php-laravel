<?php

namespace Jetimob\Juno\Exception;

class EmptyResponseClassException extends JunoException
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf('expected $responseClass declaration in \'%s\', got nothing', $class));
    }
}
