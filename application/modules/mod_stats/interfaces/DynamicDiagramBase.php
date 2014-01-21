<?php

/**
 * 
 * 
 *
 * @author kolia
 */
abstract class DynamicDiagramBase {

    const DAY = 0;
    const MONTH = 1;
    const YEAR = 2;

    /**
     * YYYY-MM-DD
     * @var string 
     */
    protected $dateFrom;

    /**
     * YYYY-MM-DD
     * @var string 
     */
    protected $dateTo;

    /**
     * Date interval
     * 0 - day
     * 1 - month
     * 2 - year
     * @var int
     */
    protected $dateInterval;

    /**
     *
     * @var type 
     */
    protected $db;

    /**
     * Setting and checking main params
     * @param string $dateFrom start from date
     * @param string $dateTo end date
     * @param string|int $dateInterval group condition (day, month, or year)
     */
    public function __construct($dateFrom, $dateTo, $dateInterval) {

        // setting date range
        $pattern = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        if (preg_match($pattern, $dateFrom)) {
            $this->dateFrom = $dateFrom;
        }
        if (preg_match($pattern, $dateFrom)) {
            $this->dateTo = $dateTo;
        }

        // setting date interval
        if (is_string($dateInterval)) {
            $array = array('day' => self::DAY, 'month' => self::MONTH, 'year' => self::YEAR);
            $this->dateInterval = isset($array[$dateInterval]) ? $array[$dateInterval] : NULL;
        }
        if (is_numeric($dateInterval) & in_array($dateInterval, array(1, 2, 3))) {
            $this->dateInterval = $dateInterval;
        }

        $this->db = CI::$APP->db;
    }

    /**
     * Runs query, loads returns data
     */
    abstract public function getData($lines);

    /**
     * Returns result
     * @param mixed $additionalParams (optional) 
     * @return boolean
     */
    public function getDynamicData(array $lines = array()) {
        if (is_null($this->dateFrom) || is_null($this->dateTo) || is_null($this->dateInterval)) {
            return FALSE;
        }
        return $this->getData($lines);
    }

}

?>
