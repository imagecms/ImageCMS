<?php

trait DateIntervalTrait {

    /**
     * Returns date pattern for mysql (select part)
     * @param int|string $dateInterval
     * @return string
     */
    public function getDatePattern($dateInterval) {
        // date pattern for mysql
        switch ($dateInterval) {
            case 1:
            case 'month':
                return '%Y-%m';
            case 2:
            case 'year':
                return '%Y';
            default: // 0: day
                return '%Y-%m-%d';
        }
    }

}