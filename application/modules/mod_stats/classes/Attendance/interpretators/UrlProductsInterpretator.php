<?php

/**
 * 
 *
 * @author 
 */
class UrlProductsInterpretator implements IUrlInterpretator {

    /**
     * Data from `shop_products` table  (url and id)
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
        $result = $ci->db->select(array('id', 'url'))->get('shop_products')->result_array();
        foreach ($result as $row) {
            $this->urlIds[$row['url']] = $row['id'];
        }
    }

    public function getResult() {
        return $this->attendanceData;
    }

    public function getTypeId() {
        return 1;
    }

    public function interprate($urlRow) {
        if (preg_match('/^[\/]{0,1}shop\/product\/(.*)$/', $urlRow['url'], $matches)) {
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
