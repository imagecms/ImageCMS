<?php

/**
 * 
 *
 * @author kolia
 */
class ZeroFiller {

    const DAY = 1;
    const MONTH = 2;
    const YEAR = 3;

    public static function fill(array $values, $timeKey, $valueKey, $dateRange) {



        switch ($dateRange) {
            case self::DAY;
            case 'day':
                $interval = 60 * 60 * 24;
                break;
            case self::MONTH;
            case 'month':
                $interval = 60 * 60 * 24 * 30;
                break;
            case self::YEAR;
            case 'year':
                $interval = 60 * 60 * 24 * 365;
                break;
            default:
                return FALSE;
        }

        // into miliseconds
        $interval *= 1000;


        $filledValues = array();

        for ($i = 1; $i < count($values); $i++) {
            $currentTime = $values[$i][$timeKey];
            $prevTime = $values[$i - 1][$timeKey];
            $difference = $currentTime - $prevTime;

            $filledValues[] = $values[$i - 1];


            if ($difference > $interval) { // значить є прогалина - треба заповнити нулями
                $countOfEmptyIntervals = floor($difference / $interval);                

                if (($difference % $interval) == 0) {
                    $countOfEmptyIntervals--;
                }


                for ($j = 0; $j < $countOfEmptyIntervals; $j++) {
                    $filledValues[] = array(
                        $timeKey => $currentTime += $interval,
                        $valueKey => 0,
                    );
                }
            }
        }

        $filledValues[] = $values[$i - 1];

        return $filledValues;
    }

}

?>
