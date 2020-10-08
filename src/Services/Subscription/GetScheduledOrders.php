<?php

namespace App\Services\Subscription;

use App\Entities\Subscription;

class GetScheduledOrders
{
    /* Generate the array of scheduled orders
     * for the given subscription and number of weeks
     */
    public function handle(Subscription $subscription, int $forNumberOfWeeks = 6): array
    {
        //
    }
}