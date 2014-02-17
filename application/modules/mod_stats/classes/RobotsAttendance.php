<?php

/**
 * Class Attendance for mod_stats module (for robots)
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class RobotsAttendance {

    const PAGE = 1;
    const CATEGORY = 2;
    const SHOP_CATEGORY = 3;
    const PRODUCT = 4;

    /**
     *
     * @var Attendance 
     */
    private static $instance;

    /**
     * Data for table `mod_stats_attendance`
     * @var array 
     */
    private $attendanceData;

    /**
     * Ids for database from robots declared in file /var/www/image.loc/application/config/user_agents.php
     * @var array
     */
    private $robots = array(
        1 => 'googlebot',
        2 => 'msnbot',
        3 => 'baiduspider',
        4 => 'bingbot',
        5 => 'slurp',
        6 => 'yahoo',
        7 => 'askjeeves',
        8 => 'fastcrawler',
        9 => 'infoseek',
        10 => 'lycos',
        11 => 'yandex',
    );

    private function __construct() {
        ;
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Attendance;
        }
        return self::$instance;
    }

    public function __destruct() {
        if (!is_null($this->attendanceData))
            CI::$APP->db->insert('mod_stats_attendance_robots', $this->attendanceData);
    }

    /**
     * 
     * @param array $coreData
     * @param string $robotName
     */
    public function add($coreData, $robotName) {
        if (FALSE == $typeId = $this->getTypeId($coreData['data_type'])) {
            return;
        }

        if (FALSE !== $robotId = $this->getRobotId($robotName)) {
            $this->attendanceData = array(
                'id_robot' => $robotId,
                'type_id' => $typeId,
                'id_entity' => $coreData['id'],
                'time_add' => time(),
            );
        }
    }

    /**
     * Get page type id
     * @param string $dataType
     * @return boolean|int
     */
    private function getTypeId($dataType) {
        switch ($dataType) {
            case 'page':
                return self::PAGE;
            case 'category':
                return self::CATEGORY;
            case 'shop_category':
                return self::SHOP_CATEGORY;
            case 'product':
                return self::PRODUCT;
            default:
                return FALSE;
        }
    }

    /**
     * 
     * @param string $robotName
     * @return boolean|int
     */
    public function getRobotId($robotName) {
        foreach ($this->robots as $id => $name) {
            if ($name == $robotName) {
                return $id;
            }
        }
        return FALSE;
    }

    /**
     * 
     * @param type $robotId
     * @return boolean
     */
    public function getRobotName($robotId) {
        if (key_exists($robotId, $this->robots)) {
            return $this->robots[$robotId];
        }
        return FALSE;
    }

}

?>
