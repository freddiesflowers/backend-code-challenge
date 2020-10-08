<?php

namespace App\Entities;

use Carbon\Carbon;

class Subscription
{
    const STATUS_ACTIVE = 1;
    const STATUS_CANCELLED = 2;

    const STATUSES_ALLOWED = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    const PLAN_WEEKLY = 1;
    const PLAN_FORTNIGHTLY = 2;

    const PLANS_ALLOWED = [
        self::PLAN_WEEKLY => 'Weekly',
        self::PLAN_FORTNIGHTLY => 'Fortnightly',
    ];

    private int $status;

    private int $plan;

    private ?Carbon $nextDeliveryDate;
}