<?php

namespace App\Services\Plans;

use App\Entities\ScheduledOrder;
use App\Entities\Subscription;
use Carbon\Carbon;

class FortnightlyPlan implements Plans
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

        do {
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
        $i = 0;

        foreach ($dates as $date) {
            $orders[$i] = new ScheduledOrder(new Carbon($date), self::interval($i));
            $orders[$i]->setHoliday(false);

            $i++;
        }

        return $orders;
    }

    /**
     * @param int $i
     * @return bool
     */
    public function interval(int $i): bool
    {
        return ($i % 2 != 0)? false : true;
    }
}