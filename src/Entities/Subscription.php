<?php

namespace App\Entities;

use Carbon\Carbon;

class Subscription
{
    /**
     * The statuses a subscription can have.
     *
     * @var int
     */
    const STATUS_ACTIVE    = 1;
    const STATUS_CANCELLED = 2;

    /**
     * The allowed statuses.
     *
     * @var array
     */
    const STATUSES_ALLOWED = [
        self::STATUS_ACTIVE    => 'Active',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    /**
     * The plans a subscription can have.
     *
     * @var int
     */
    const PLAN_WEEKLY      = 1;
    const PLAN_FORTNIGHTLY = 2;

    /**
     * The allowed plans.
     *
     * @var array
     */
    const PLANS_ALLOWED = [
        self::PLAN_WEEKLY      => 'Weekly',
        self::PLAN_FORTNIGHTLY => 'Fortnightly',
    ];

    /**
     * The subscription status.
     *
     * @var int
     */
    protected $status;

    public function setStatus(int $status) {
        $this->status = self::STATUSES_ALLOWED[$status];
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    /**
     * The subscription plan.
     *
     * @var int
     */
    protected $plan;

    public function setPlan(int $plan)
    {
        $this->plan = self::PLANS_ALLOWED[$plan];
        return $this;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * The next delivery date for this subscription.
     *
     * @var \Carbon\Carbon|null
     */
    protected $nextDeliveryDate;

    public function setNextDeliveryDate(Carbon $nextDeliveryDate)
    {
        $this->nextDeliveryDate = $nextDeliveryDate;
        return $this;
    }

    public function getNextDeliveryDate()
    {
        return $this->nextDeliveryDate;
    }
}
