<?php

namespace App\Services\Subscription;

use App\Entities\ScheduledOrder;
use App\Entities\Subscription;
use App\Services\Plans\WeeklyPlan;
use App\Services\Plans\FortnightlyPlan;
use Carbon\Carbon;

class GetScheduledOrders
{
    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param \App\Entities\Subscription $subscription
     * @param int                        $forNumberOfWeeks
     *
     * @return array|null
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6): ?array
    {
        $orders = [];
        if ($subscription->getStatus() !== "Active") { return null;}

        $plan = $subscription->getPlan();

        if ($plan == 'Weekly') {
            $orders = WeeklyPlan::getOrders($subscription, $forNumberOfWeeks);
        }
        if ($plan == 'Fortnightly') {
            $orders = FortnightlyPlan::getOrders($subscription, $forNumberOfWeeks);
        }

        return $orders;
    }


}