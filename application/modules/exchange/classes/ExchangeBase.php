<?php

namespace exchange\classes;

/**
 * Base class for import/export
 *
 * each class that extends ExchangeBase can
 * request its properties from db and xml
 *
 * @author kolia
 * @property \CI_DB_active_record $db
 */
abstract class ExchangeBase {

    // "multisingleton"
    protected static $instances = array();

    /**
     *
     * @var type
     */
    protected $db;

    /**
     *
     * @var ExchangeDataLoad
     */
    protected $dataLoad;

    /**
     *
     * @var SimpleXMLElement
     */
    protected $importData;

    /**
     * Current locale
     * @var string
     */
    protected $locale;

    /**
     *
     * @var type
     */
    protected $xml;

    /**
     * Storing results about queries
     * @var array
     */
    public static $stats = array();

    private function __construct() {
        $this->dataLoad = ExchangeDataLoad::getInstance();
        $this->locale = \MY_Controller::getCurrentLocale();
        $ci = &get_instance();
        $this->db = $ci->db;
    }

    private function __clone() {

    }

    /**
     *
     * @return
     */
    public static function getInstance() {
        $class = get_called_class();
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }

    public function __get($name) {
        return $this->dataLoad->$name;
    }

    /**
     * Alias for CI insert_batch
     * @param string $tableName
     * @param array $data
     */
    protected function insertBatch($tableName, $data) {
        if (FALSE == (count($data) > 0)) {
            return;
        }

        foreach ($data as $value) {
            $this->db->set($value)->insert($tableName);
        }

        $error = $this->db->_error_message();

        if (!empty($error)) {
            throw new \Exception("Error on inserting into `{$tableName}`: " . $error);
        }
        // gathering statistics
        ExchangeBase::$stats[] = array(
            'query type' => 'insert',
            'table name' => $tableName,
            'affected rows' => count($data)
        );
    }

    public function setXml(\SimpleXMLElement $xml) {
        $this->xml = $xml;
    }

    /**
     * Alias for CI update_batch
     * @param string $tableName
     * @param array $data
     * @param string $keyToComare
     */
    protected function updateBatch($tableName, array $data, $keyToComare) {
        if (FALSE == (count($data) > 0)) {
            return;
        }

        if ('shop_product_categories' == $tableName) {
            return;
        }

        //        $this->_updateBatchGroup($tableName, $data, $keyToComare); // error when more than 1 language
        $this->_updatePerOne($tableName, $data, $keyToComare);

        // gathering statistics
        ExchangeBase::$stats[] = array(
            'query type' => 'update',
            'table name' => $tableName,
            'affected rows' => count($data)
        );
    }

    /**
     *
     * @param string $tableName
     * @param array $data
     * @param string $keyToComare
     * @throws \Exception
     */
    public function _updateBatchGroup($tableName, array $data, $keyToComare) {

        $this->db->update_batch($tableName, $data, $keyToComare);

        $error = $this->db->_error_message();

        if (!empty($error)) {
            throw new \Exception("Error on updating `{$tableName}`: " . $error);
        }
    }

    /**
     *
     * @param string $tableName
     * @param array $data
     * @param string $keyToComare
     */
    public function _updatePerOne($tableName, array $data, $keyToComare) {

        foreach ($data as $rowData) {
            $this->db->update($tableName, $rowData, [$keyToComare => $rowData[$keyToComare]], 1);

            $error = $this->db->_error_message();
            if (empty($error)) {
                continue;
            }

            log_message('error', sprintf("DB error: '%s'", $error));

            if (config_item("update:failOnError") == true) {
                throw new \Exception("Error on updating `{$tableName}`: " . $error);
            }
        }
    }

    /**
     * Return statistic
     * @return array
     */
    public function getStats() {
        return $this->stats;
    }

    /**
     * Sets the data for import, starts import
     * @param \SimpleXMLElement $importData
     */
    public function import(\SimpleXMLElement $importData) {
        if (!count($importData) > 0) {
            return;
        }
        $this->importData = $importData;
        $this->import_();
        return;
    }

    /**
     * Runs the import process
     */
    abstract protected function import_();

}