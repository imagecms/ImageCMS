<?php

use mod_link\models\PageLink;
use mod_link\models\PageLinkProduct;
use mod_link\models\PageLinkProductQuery;
use mod_link\models\PageLinkQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Mod_link extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_link');
    }

    /**
     * @param $pageId
     * @return array
     */
    public function getLinkByPage($pageId) {
        $pageLink = PageLinkQuery::create()->findOneActiveByPageId($pageId);
        return $pageLink;
    }

    /**
     * @param int $productId
     * @return  array
     */
    public function getLinksByProduct($productId) {
        $pageLinkProducts = PageLinkProductQuery::create()
            ->joinWithPageLink()
            ->usePageLinkQuery()
            ->filterByaActive()
            ->filterByShowOn(true)
            ->endUse()
            ->filterByProductId($productId)
            ->find();

        $links = [];
        /** @var PageLinkProduct $pageLinkProduct */
        foreach ($pageLinkProducts as $pageLinkProduct) {
            $link = $pageLinkProduct->getPageLink();
            $page = $this->getPage($link->getPageId());
            $page = $this->load->module('cfcm')->connect_fields($page, 'page');
            $link->setPageData($page);
            array_push($links, $link);
        }

        return $links;
    }

    /**
     * @param $id\
     * @return mixed page data
     */
    private function getPage($id) {
        $query = $this->db->select('content.*')
            ->select('CONCAT(content.cat_url,content.url ) as full_url')
            ->where('id', $id)
            ->where('lang', $this->config->item('cur_lang'))
            ->get('content');

        if ($query->num_rows() > 0) {
            $page = $query->row_array();
            return $page;
        }

    }

    /**
     * @return string locale
     */
    private static function getPageEditLocale() {
        $langId = CI::$APP->uri->segment(5);
        $db = CI::$APP->db;
        $lang = MY_Controller::defaultLocale();
        $query = $db->select('identif')->where('id', $langId)->get('languages');
        if ($query->num_rows() > 0) {
            $lang = $query->row_array()['identif'];
        }

        return $lang;
    }

    /**
     * Register page extension tab content
     * @throws Exception
     */
    public static function adminAutoload() {
        \CMSFactory\Events::create()->onAdminPagePreEdit()->setListener('_extendPageAdmin');
        \CMSFactory\Events::create()->onAdminPageUpdate()->setListener('_updateProducts');
    }

    /**
     * @param $page
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function _updateProducts($page) {
        $ci = CI::$APP;
        $linkedData = $ci->input->post('linked') ?: [];

        $pageId = $page['id'];
        $productIds = array_key_exists('products', $linkedData) ? $linkedData['products'] : [];
        $showOn = array_key_exists('show_on', $linkedData) ? true : false;
        $activeFrom = array_key_exists('active_from', $linkedData) ? strtotime($linkedData['active_from']) : null;
        $activeTo = array_key_exists('active_to', $linkedData) ? strtotime($linkedData['active_to']) : null;
        $permanent = array_key_exists('permanent', $linkedData) ? true : false;

        $pageLink = PageLinkQuery::create()->findOneByPageId($pageId);
        $pageLink = $pageLink ?: new PageLink();

        $pageLink->setPageId($pageId);
        $pageLink->setShowOn($showOn);
        $pageLink->setActiveFrom($activeFrom);
        $pageLink->setActiveTo($activeTo);
        $pageLink->setPermanent($permanent);

        $products = SProductsQuery::create()->filterById($productIds, Criteria::IN)->find();

        $pageLinkProductsCollection = new ObjectCollection();
        PageLinkProductQuery::create()->filterByLinkId($pageLink->getId())->delete();
        foreach ($products as $product) {
            $pageLinkProduct = new PageLinkProduct();
            $pageLinkProduct->setPageLink($pageLink);
            $pageLinkProduct->setProductId($product->getId());
            $pageLinkProductsCollection->append($pageLinkProduct);
        }

        $pageLink->setPageLinkProducts($pageLinkProductsCollection);
        $pageLink->save();

    }

    /**
     * Display module template on tab "Modules additions" when edit page.
     * @param array $data
     */
    public static function _extendPageAdmin($data) {

        $pageId = $data['pageId'];

        $locale = self::getPageEditLocale();

        $pageLink = PageLinkQuery::create()->findOneByPageId($pageId);

        $pageLink = $pageLink ?: new PageLink();

        $view = \CMSFactory\assetManager::create()
            ->setData(compact('pageLink', 'locale'))
            ->registerScript('script')
            ->fetchTemplate('/admin/pageTab');

        \CMSFactory\assetManager::create()
            ->appendData('moduleAdditions', $view);
    }

    public function _install() {
        $this->load->dbforge();

        $page_link_fields = [
                             'id'          => [
                                               'type'           => 'INT',
                                               'constraint'     => 11,
                                               'auto_increment' => true,
                                              ],
                             'page_id'     => [
                                               'type'       => 'INT',
                                               'constraint' => 11,
                                              ],
                             'active_from' => [
                                               'type'       => 'int',
                                               'constraint' => 11,
                                               'null'       => true,
                                              ],
                             'active_to'   => [
                                               'type'       => 'int',
                                               'constraint' => 11,
                                               'null'       => true,
                                              ],
                             'show_on'     => [
                                               'type'    => 'TINYINT',
                                               'default' => 1,
                                              ],
                             'permanent'   => [
                                               'type'    => 'TINYINT',
                                               'default' => 1,
                                              ],
                            ];

        $this->dbforge->add_field($page_link_fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('page_link');

        $page_link_products_fields = [
                                      'link_id'    => [
                                                       'type'       => 'INT',
                                                       'constraint' => 11,
                                                      ],
                                      'product_id' => [
                                                       'type'       => 'INT',
                                                       'constraint' => 11,
                                                      ],
                                     ];
        $this->dbforge->add_field($page_link_products_fields);
        $this->dbforge->add_key(['link_id', 'product_id']);

        $this->dbforge->create_table('page_link_product', TRUE);

        $this->db->where('name', 'mod_link')
            ->update('components', ['autoload' => '1']);

    }

    public function _deinstall() {
        $this->load->dbforge();
        $this->dbforge->drop_table('page_link');
        $this->dbforge->drop_table('page_link_product');
    }

}

/* End of file sample_module.php */