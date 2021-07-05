<?php

namespace Jetimob\Juno\Api\Subscription;

use Jetimob\Juno\Api\JunoResponse;
use Jetimob\Juno\Entity\PlanBase;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createPlans
 */
class CreatePlanResponse extends JunoResponse
{
    use PlanBase;
}
