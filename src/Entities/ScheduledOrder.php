<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var Carbon
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
     * @param Carbon $deliveryDate
     * @param bool   $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval = $isInterval;
    }

    // TODO: add comments for all methods
    public function isInterval() { return $this->interval; }

    public function setHoliday(bool $holiday)
    {
        $this->holiday = ($this->interval ? $holiday : $this->holiday);
    }

    public function isHoliday() { return $this->holiday; }

    public function getDeliveryDate() { return $this->deliveryDate; }

    public function setOptIn(bool $optIn)
    {
        $this->optIn = (!$this->interval ? $optIn : $this->optIn);
    }

    public function isOptIn() { return $this->optIn; }
}