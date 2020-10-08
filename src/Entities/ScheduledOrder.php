<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    private Carbon $deliveryDate;

    private bool $holiday = false;

    private bool $optIn = false;

    private bool $interval = true;

    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval = $isInterval;
    }
}
