<?php

namespace Jetimob\Juno\Exception;

class MissingPropertyBodySchemaException extends JunoException
{
    public function __construct(string $property, $instance)
    {
        parent::__construct(
            sprintf(
                'missing property \'%s\' declared in $bodySchema of %s',
                $property,
                get_class($instance)
            )
        );
    }
}
