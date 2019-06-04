<?php

namespace App\Entities;

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

    public function setStatus(Int $status) {
        $this->status = self::STATUSES_ALLOWED[$status];
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

    public function setPlan(Int $plan) {
        $this->plan = self::PLANS_ALLOWED[$plan];
    }

    public function getPlan() {
        return $this->plan;
    }

    /**
     * The next delivery date for this subscription.
     *
     * @var \Carbon\Carbon|null
     */
    protected $nextDeliveryDate;

    public function setNextDeliveryDate($nextDeliveryDate) {
        $this->nextDeliveryDate = $nextDeliveryDate;
    }

    public function getNextDeliveryDate() {
        return $this->nextDeliveryDate;
    }
}
