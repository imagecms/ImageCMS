<?php

/**
 * 
 *
 * @author 
 */
class Attendance {

    /**
     * Clear table `urls` after every parsing or not
     * If the data is not cleared, then the id of the last row processed from urls will be saved
     * @var boolean
     */
    public $clearUrls = TRUE;

    /**
     * Instance of CI::$db
     * @var type 
     */
    protected $db;

    /**
     *
     * @var array 
     */
    protected $parsers = array();

    /**
     * Save statuses from parsers
     * (key - id of parser, value - boolean 
     * (true if data was success parsed and saved in DB))
     * @var array
     */
    public $results = array();

    /**
     * 
     */
    public function __construct() {
        $this->db = CI::$APP->db;
    }

    public function addInterpretator(IUrlInterpretator $parser) {
        $this->parsers[$parser->getTypeId()] = $parser;
    }

    /**
     * Parses all data
     */
    public function processData() {
        $urlsData = $this->getUrlsData();
        foreach ($urlsData as $row) {
            foreach ($this->parsers as $parserId => $parser) {
                // results are stored in parsers
                $parser->interprate($row);
            }
        }
    }

    /**
     * Returning results
     * @param int (optional) $parserId unique id of parser. 
     * if not specifies then all data will be returned
     * @return boolean|array data structure is like for table `attendance`
     */
    public function getResults($parserId = NULL) {
        if ($parserId == NULL) {
            // merging all data into one array
            $results = array();
            foreach ($this->parsers as $parserId => $parser) {
                $results = array_merge($results, $parser->getResult());
            }
            return $results;
        }
        if (key_exists($parserId, $this->parsers)) {
            return $this->parsers[$parserId];
        }
        return false;
    }

    /**
     * Saving all results in base
     * @return type
     */
    public function saveAllResults() {
        foreach ($this->parsers as $parserId => $parser) {
            $this->db->insert_batch('mod_stats_attendance', $parser->getResult());
        }
    }

    /**
     * 
     * @return \SplFixedArray
     */
    protected function getUrlsData() {
        if ($this->clearUrls == TRUE) {
            return \SplFixedArray::fromArray($this->db->get('mod_stats_urls'));
        } else {
            // тут треба взяти останню оброблену ід, і вибрати все що більше неї
        }
    }

}

?>
