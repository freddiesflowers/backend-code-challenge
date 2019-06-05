<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var \Carbon\Carbon
     */
    protected $deliveryDate;

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Is this delivery marked as a holiday that will be skipped.
     *
     * @var bool
     */
    protected $holiday = false;

    public function setHoliday(bool $holiday)
    {
        return $this->holiday = $holiday;
    }

    public function isHoliday()
    {
        return $this->holiday && $this->interval;
    }

    /**
     * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
     *
     * @var bool
     */
    protected $optIn = false;

    public function setOptIn(bool $optIn)
    {
        return $this->optIn = $optIn;
    }

    public function isOptIn()
    {
        return $this->optIn && !$this->interval;
    }

    /**
     * Is this scheduled order part of the subscriptions normal plan cycle.
     *
     * @var bool
     */
    protected $interval = true;

    public function isInterval()
    {
        return $this->interval;
    }

    /**
     * ScheduledOrder constructor.
     *
     * @param \Carbon\Carbon     $deliveryDate
     * @param \App\Entities\bool $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval     = $isInterval;
    }
}
