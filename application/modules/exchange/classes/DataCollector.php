<?php

namespace exchange\classes;

/**
 * Class-helper for Products
 * (to simplify product processing)
 *
 * @author kolia
 */
class DataCollector {

    /**
     *
     * @var array
     */
    protected $tablesData = array();

    /**
     *
     * @var array
     */
    protected $currentPassData = array();

    /**
     *
     * @var string|integer
     */
    protected $keys = array();

    /**
     *
     * @param string $table
     * @param array $data
     * @param string|integer $key array key (optioanl)
     */
    public function addData($table, array $data, $key = NULL) {
        if (count($data) == 0) {
            return FALSE;
        }
        if (isset($this->currentPassData[$table])) {
            $this->currentPassData[$table] = array_merge($this->currentPassData[$table], $data);
        } else {
            $this->currentPassData[$table] = $data;
        }
        if ($key != NULL) {
            $this->keys[$table] = $key;
        }
        return FALSE;
    }

    /**
     * Similar to addData, but adds rows to existing "product"
     * @param type $table
     * @param array $data
     * @param type $key
     */
    public function updateData($table, array $data, $key = NULL) {
        if (count($data) == 0) {
            return FALSE;
        }
        $this->currentPassData[$table][] = $data;
        if ($key != FALSE) {
            $this->keys[$table] = $key;
        }
        return FALSE;
    }

    /**
     * Collects data of current pass, getting ready for new pass
     */
    public function newPass() {
        foreach ($this->currentPassData as $tableName => $tableData) {
            if (isset($this->keys[$tableName])) {
                $currentKey = $this->keys[$tableName];
                if (key_exists($tableName, $this->tablesData)) {
                    if (key_exists($currentKey, $this->tablesData[$tableName])) {
                        $oldData = $this->tablesData[$tableName][$currentKey];
                        $this->tablesData[$tableName][$currentKey] = array_merge($oldData, $tableData);
                    } else {
                        $this->tablesData[$tableName][$currentKey] = $tableData;
                    }
                } else {
                    $this->tablesData[$tableName][$currentKey] = $tableData;
                }
            } else {
                $this->tablesData[$tableName][] = $tableData;
            }
        }
        $this->currentPassData = array();
        $this->keys = array();
    }

    /**
     *
     * @param string $tableBName
     */
    public function getData($tableBName = NULL) {
        if ($tableBName == NULL) {
            return $this->tablesData;
        }
        if (key_exists($tableBName, $this->tablesData)) {
            return $this->tablesData[$tableBName];
        }
        return array();
    }

    /**
     *
     * @param string $tableBName
     * @return boolean
     */
    public function unsetData($tableBName = NULL) {
        if ($tableBName == NULL) {
            $this->tablesData = array();
            return TRUE;
        }
        if (key_exists($tableBName, $this->tablesData)) {
            unset($this->tablesData[$tableBName]);
            return TRUE;
        }
        return FALSE;
    }

}