<?php

namespace App\Services\Plans;

use App\Entities\ScheduledOrder;
use App\Entities\Subscription;
use Carbon\Carbon;

class WeeklyPlan implements Plans
{

    /**
     * @param Subscription $subscription
     * @param int $forNumberOfWeeks
     * @return array
     * @throws \Exception
     */
    static public function getOrders(Subscription $subscription, int $forNumberOfWeeks): array
    {
        $i = $dayWeek = 0;
        $dates = [];

        do{
            $dates[] = $subscription->getNextDeliveryDate()->addDays($dayWeek)->toDayDateTimeString();
            $dayWeek = 7;
            $i++;
        } while ($i < $forNumberOfWeeks);

        return self::setScheduler($dates);
    }

    /**
     * @param array $dates
     * @return array
     * @throws \Exception
     */
    public function setScheduler(array $dates): array
    {
        $orders = [];
        foreach($dates as $date) {
            $orders[] = new ScheduledOrder(new Carbon($date), true);
        }

        return $orders;
    }
}