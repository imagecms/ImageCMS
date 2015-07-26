<?php

namespace template_manager\legacy;

/**
 * This class is for controll every demodata install
 * to check if the migrations where implemented in demodata sql-file.
 * If not, then fix all needed columns
 * 
 * 
 * @author kolia
 */
class DemodataMigrationsControl extends \CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function run() {
        try {
            $this->corrections_after_ci_and_propel_update();
        } catch (\Exception $ex) {
            // well, if something went wrong do nothing...
        }
    }

    /**
     * two colums where changed after udpate of CI & Propel
     */
    protected function corrections_after_ci_and_propel_update() {

        $this->ifColumnExistsThenAlter('shop_orders', 'key', [
            'name' => 'order_key',
            'type' => 'VARCHAR',
            'constraint' => '255',
        ]);

        $this->ifColumnExistsThenAlter('shop_gifts', 'key', [
            'name' => 'gift_key',
            'type' => 'VARCHAR',
            'constraint' => '255',
        ]);
    }

    /**
     * Helper to modify columns
     * @param string $tableName
     * @param string $oldColumnName if this column will exists in table, then next argument will be used
     * @param array $newColumnData 
     */
    protected function ifColumnExistsThenAlter($tableName, $oldColumnName, $newColumnData) {
        $columns = $this->getTableColumns($tableName);
        if ($columns == null) {
            return;
        }
        if (
                in_array($oldColumnName, $columns) &&
                !in_array($newColumnData['name'], $columns)
        ) {
            $this->dbforge->modify_column($tableName, [$oldColumnName => $newColumnData]);
        }
    }

    /**
     * 
     * @param string $tableName
     * @return null|array
     */
    protected function getTableColumns($tableName) {
        $result = $this->db->query("DESCRIBE `{$tableName}`")->result_array();
        if (!$result) {
            return null;
        }
        $fields = [];
        for ($i = 0; $i < count($result); $i++) {
            $fields[] = $result[$i]['Field'];
        }
        return $fields;
    }

}
