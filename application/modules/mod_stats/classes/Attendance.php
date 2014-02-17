<?php

/**
 * Class Attendance for mod_stats module
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class Attendance {

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
            CI::$APP->db->insert('mod_stats_attendance', $this->attendanceData);
    }

    /**
     * 
     * @param string $url
     */
    public function add($coreData, $userId) {
        if (FALSE == $typeId = $this->getTypeId($coreData['data_type'])) {
            return;
        }

        $this->attendanceData = array(
            'id_user' => $userId,
            'type_id' => $typeId,
            'id_entity' => $coreData['id'],
            'time_add' => time(),
        );
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

}

?>
