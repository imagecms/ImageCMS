<?php

/**
 * 
 *
 * @author 
 */
class UrlCategoriesInterpretator implements IUrlInterpretator {

    /**
     * Data from `shop_category` table  (url and id)
     * @var array
     */
    protected $urlIds;

    /**
     * Data for `attendance` table
     * @var array
     */
    protected $attendanceData;

    public function __construct() {
        $ci = &get_instance();
        $result = $ci->db->select(array('id', 'full_path'))->get('shop_category')->result_array();
        foreach ($result as $row) {
            $this->urlIds[$row['full_path']] = $row['id'];
        }
    }

    public function getResult() {
        return $this->attendanceData;
    }

    public function getTypeId() {
        return 2;
    }

    public function interprate($row) {
        if (preg_match('/^[\/]{0,1}shop\/category\/(.*)$/', $row['url'], $matches)) {
            if (isset($this->urlIds[$matches[1]])) {
                $this->attendanceData[] = array(
                    'type_id' => $this->getTypeId(),
                    'id_entity' => $this->urlIds[$matches[1]],
                    'date' => $urlRow['date']
                );
            }
        }
    }

}

?>
