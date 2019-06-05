<?php

namespace App\Services\Subscription;

use App\Entities\ScheduledOrder;
use App\Entities\Subscription;
use Carbon\Carbon;

class GetScheduledOrders
{

    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param \App\Entities\Subscription $subscription
     * @param int                        $forNumberOfWeeks
     *
     * @return array
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
    {

        $deliveryDate = $subscription->getNextDeliveryDate();

        if($deliveryDate === null){
            return [];
        }

        $scheduledOrders = [];
        for ($i = 0; $i < $forNumberOfWeeks; $i++) {
            $scheduledOrders[$i] = new ScheduledOrder($deliveryDate->copy(), true);

            $deliveryDate->addWeek();
        }

        return $scheduledOrders;
    }

}