<?php

/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class Stats_model_users extends CI_Model {

    protected $locale;

    /**
     * Default params for method getOrdersByDateRange
     * @var array
     */
    protected $params = array(
        'interval' => 'day', //  date interval (string: day|month|week|year)
        'start_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
        'end_date' => NULL, // NULL for all or date in format (string: YYYY-MM-DD)
    );

    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    public function getUsersOnline() {
        
    }

    public function getRegister($params) {
        if (is_array($params)) {
            foreach ($this->params as $key => $value) {
                if (key_exists($key, $params)) {
                    $this->params[$key] = $params[$key];
                }
            }
        }

        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        $query = "
            SELECT
                DATE_FORMAT(FROM_UNIXTIME(`created`), '" . $lineDiagramBase->prepareDatePattern() . "') as `date`,
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
                 " . $lineDiagramBase->prepareDateBetweenCondition('created') . " 
            GROUP BY `date`
            ORDER BY FROM_UNIXTIME(`created`)
        ";

        $result = $this->db->query($query);
        if ($result === FALSE) {
            return FALSE;
        }
        $data = array();
        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

}

?>
