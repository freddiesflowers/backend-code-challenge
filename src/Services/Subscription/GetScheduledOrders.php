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
        $scheduledOrders = array();

        // check the status is active
        if($subscription->getStatus() === 'Active'){
            $interval = true;

            for($weekNumber = 0; $weekNumber < $forNumberOfWeeks; $weekNumber++){

                $deliveryDate = (new Carbon($subscription->getNextDeliveryDate()))->startOfDay()->addWeeks($weekNumber);
                $scheduledOrders[$weekNumber] = new ScheduledOrder($deliveryDate, $interval);

                // if the plan is fornightly then modify interval
                if($subscription->getPlan() === 'Fortnightly'){
                    $interval = !$interval;
                }

            }
        }

        return $scheduledOrders;
    }
}