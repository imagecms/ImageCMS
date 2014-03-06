<?php

/**
 * Class Users_model for mod_stats module
 * @uses \CI_Model
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property CI_DB_active_record $db
 * @package ImageCMSModule
 */
class Users_model extends CI_Model {

    use DateIntervalTrait;

    protected $locale;

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    protected $params = array(
        'interval' => 'day', //  date interval (string: day|month|year)
        'dateFrom' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
        'dateTo' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
    );

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    /**
     * Setting conditions
     * @param array $params
     * - dateFrom
     * - dateTo
     * - interval
     */
    public function setParams(array $params = array()) {
        foreach ($this->params as $key => $value) {
            if (key_exists($key, $params)) {
                $this->params[$key] = $params[$key];
            }
        }
    }

    /**
     * Getting dynamic of users registration on site
     * @return boolean|array
     */
    public function getRegister() {
        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`created`), '" . $this->getDatePattern($this->params['interval']) . "') as `date`,
                `created` as `unix_date`,    
                COUNT(`id`) as `count`
            FROM 
                (SELECT 
                    `users`.`id`,
                    `users`.`created`
                 FROM 
                    `users`
                 WHERE 1
                     AND FROM_UNIXTIME(`users`.`created`) <= NOW() + INTERVAL 1 DAY 
                 GROUP BY 
                    `users`.`id`
                 ORDER BY 
                    FROM_UNIXTIME(`users`.`created`)
                ) as dtable
            WHERE 1 
                 " . $this->prepareDateBetweenCondition('created', $this->params) . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`created`)
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        return $result->result_array();
    }

}

?>
