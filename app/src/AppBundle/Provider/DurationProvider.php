<?php

namespace AppBundle\Provider;

use AppBundle\Model\Api\Response\Duration;

class DurationProvider
{
    const YEAR_DIVIDER = self::DAY_DIVIDER * 365;
    const DAY_DIVIDER = self::HOUR_DIVIDER * 24;
    const HOUR_DIVIDER = self::MIN_DIVIDER * 60;
    const MIN_DIVIDER = 60;

    public function provide(?int $durationInSec): ?Duration
    {
        if ($durationInSec === null || $durationInSec === 0) {
            return null;
        }

        $year = (int) floor($durationInSec / self::YEAR_DIVIDER);
        $durationInSec -= $year * self::YEAR_DIVIDER;

        $day = (int) floor($durationInSec / self::DAY_DIVIDER);
        $durationInSec -= $day * self::DAY_DIVIDER;

        $hour = (int) floor($durationInSec / self::HOUR_DIVIDER);
        $durationInSec -= $hour * self::HOUR_DIVIDER;

        $min = (int) floor($durationInSec / self::MIN_DIVIDER);
        $durationInSec -= $min * self::MIN_DIVIDER;

        $sec = $durationInSec;

        return (new Duration())
            ->setYear($year ?: null)
            ->setDay($day ?: null)
            ->setHour($hour ?: null)
            ->setMin($min ?: null)
            ->setSec($sec ?: null);
    }
}
