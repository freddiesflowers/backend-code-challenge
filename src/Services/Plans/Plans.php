<?php

namespace App\Services\Plans;

use App\Entities\Subscription;

interface Plans
{
    static public function getOrders(Subscription $subscription, int $forNumberOfWeeks);

    public function setScheduler(array $dates);
}