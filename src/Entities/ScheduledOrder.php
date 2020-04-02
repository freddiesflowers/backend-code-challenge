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

    /**
     * Is this delivery marked as a holiday that will be skipped.
     *
     * @var bool
     */
    protected $holiday = false;

    /**
     * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
     *
     * @var bool
     */
    protected $optIn = false;

    /**
     * Is this scheduled order part of the subscriptions normal plan cycle.
     *
     * @var bool
     */
    protected $interval = true;

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

    /**
     * @return bool
     */
    public function isInterval(): bool
    {
        return $this->interval;
    }

    /**
     * @param bool $holiday
     */
    public function setHoliday(bool $holiday)
    {
        if ($this->interval === false) {
            $this->holiday     =  false;
        } else {
            $this->holiday     = $holiday;
        }
    }

    /**
     * @return bool
     */
    public function isHoliday(): bool
    {
        return $this->holiday;
    }

    /**
     * @return Carbon
     */
    public function getDeliveryDate(): Carbon
    {
        return $this->deliveryDate;
    }

    /**
     * @param bool $optIn
     */
    public function setOptIn(bool $optIn)
    {
        if ($this->interval === true) {
            $this->optIn     =  false;
        } else {
            $this->optIn     = $optIn;
        }
    }

    /**
     * @return bool
     */
    public function isOptIn(): bool
    {
        return $this->optIn;
    }
}