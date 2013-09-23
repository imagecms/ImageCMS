<?php

namespace mod_stats\classes;

/**
 * Description of Products
 *
 * @author kolia
 */
class Search extends \MY_Controller {

    protected static $instanse;

    public function __construct() {
        parent::__construct();
        $this->load->model('stats_model_search');
        $lang = new \MY_Lang();
        $lang->load('mod_stats');
    }

    /**
     * 
     * @return Search
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    /**
     * Table representation for keywords searched
     */
    public function templateKeywordsSearched() {
//        $params = \mod_stats\classes\LineDiagramBase::create()->getParamsFromCookies();

        $keywords = $this->stats_model_search->getKeywordsByDateRange();
        return $keywords;
    }
    
    public function getBrandsInSearch(){
        var_dumps($keywords = $this->stats_model_search->queryKeywordsByDateRange(new \mod_stats\classes\LineDiagramBase()));
    }

}

?>
