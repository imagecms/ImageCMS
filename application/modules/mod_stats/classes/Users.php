<?php

namespace mod_stats\classes;

/**
 * Users stats 
 * 
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 */
class Users extends \MY_Controller {

    protected static $instanse;

    public function __construct() {
        parent::__construct();
        /** Load users model * */
        $this->load->model('stats_model_users');
    }

    /**
     * 
     * @return Users
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    /**
     * 
     */
    public function getOnline() {
        
    }

    /**
     * 
     */
    public function getRegister() {
        $usersRegister = $this->stats_model_users->getRegister($params);
        $lineDiagramBase = new \mod_stats\classes\LineDiagramBase();

        // getting data by only specified field
        $dataByField = array();
        foreach ($usersRegister as $user) {
            $dataByField[$user['date']] = $user['count'];
        }
        unset($usersRegister);

        // filling by zeros for wright data representation in diagram
        $filledWithZeros = $lineDiagramBase->fillMissingWithZero($dataByField);
        unset($dataByField);


        // timestamp for diagram
        $ts = array();
        foreach ($filledWithZeros as $date => $count) {
            $ts[strtotime($date)] = $count;
        }
        ksort($ts);
        unset($filledWithZeros);

        // creating array with structure for nvd3 line diagram
        $ts_ = array();
        foreach ($ts as $key => $value) {
            $ts_[] = array(
                'x' => $key,
                'y' => $value
            );
        }

        $result = array(
            'type' => 'line',
            'data' => array(
                0 => array(
                    'key' => 'Количество регистраций',
                    'values' => $ts_
                )
            )
        );

        return json_encode($result);
    }

}

?>
