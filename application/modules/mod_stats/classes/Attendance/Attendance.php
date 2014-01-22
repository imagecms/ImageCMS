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

    public function addParser(IUrlParser $parser) {
        $this->parsers[$parser->getTypeId()] = $parser;
    }

    public function processData() {
        $urlsData = $this->getUrlsData();
        foreach ($this->parsers as $parserId => $parser) {
            $parser->setData($urlsData);
            $parser->processData();
            $this->db->insert_batch('mod_stats_attendance', $parser->getData());
            $error = $this->db->_error_message();
            $this->results[$parserId] = empty($error) ? TRUE : FALSE;
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
