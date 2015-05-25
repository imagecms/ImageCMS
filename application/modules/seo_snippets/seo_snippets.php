<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Seo snippets module
 * @author Gula Andriy <a.gula@imagecms.net>
 * @copyright (c) 2015, Gula Andriy
 * @version 1.0
 * 
 * @property Seo_snippets_model $seo_snippets_model 
 */
class Seo_snippets extends MY_Controller {

    /**
     * Array of site settings
     * @var array
     */
    private $settings;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('seo_snippets');

        $this->load->model('seo_snippets_model');
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
        \CMSFactory\Events::create()->onProductPageLoad()
                ->setListener('makeProductSnippet');

        $this->settings = $this->cms_base->get_settings();

        $WebSite = $this->makeWebSiteSnippet();
        $LocalBusiness = $this->makeLocalBusinessSnippet();

        $data = json_encode(array_filter([$LocalBusiness, $WebSite]));

        \CMSFactory\assetManager::create()->registerJsScript($data, FALSE, 'after', 'application/ld+json');
    }

    public function _install() {
        $this->db->where('name', 'seo_snippets')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    public function _deinstall() {
        
    }

    private function makeLocalBusinessSnippet() {
        return $LocalBusiness = array(
            '@context' => 'http://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $this->settings['site_title'],
            'image' => site_url(siteinfo('siteinfo_logo_url')),
            'telephone' => siteinfo('siteinfo_mainphone'),
            'email' => siteinfo('Email'),
            'address' => array(
                '@type' => 'PostalAddress',
                'streetAddress' => siteinfo('siteinfo_address'),
            ),
            'url' => site_url(),
        );
    }

    private function makeWebSiteSnippet() {
        return $WebSite = array(
            '@context' => 'http://schema.org',
            '@type' => 'WebSite',
            'url' => site_url(),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => site_url('shop/search?text={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ),
        );
    }

    /**
     * 
     * @param array $product
     */
    public static function makeProductSnippet($product) {
        /* @var $model SProducts */
        $model = $product['model'];

        $ci = &get_instance();

        if (!strstr($ci->uri->uri_string(), 'shop/product/')) {
            return;
        } else {
            if (encode($model->getName()) == encode($model->getFirstVariant()->getName())) {
                $name = htmlspecialchars($model->getName());
            } else {
                $name = htmlspecialchars($model->getName() . ' ' . $model->getFirstVariant()->getName());
            }
            $name = trim($name);

            $aggregateRating = $ci->seo_snippets_model->getAggregateRating($model->getId());

            $Product = array(
                '@context' => 'http://schema.org',
                '@type' => 'Product',
                'name' => $name,
                'image' => site_url($model->getFirstVariant()->getMainPhoto()),
                'description' => $model->getFullDescription(),
                'url' => shop_url('product/' . $model->getUrl()),
                'brand' => array(),
                'offers' => array(
                    '@type' => 'Offer',
                    "availability" => $model->getFirstVariant()->getStock() > 0 ? "http://schema.org/InStock" : "http://schema.org/SoldOut",
                    'price' => $model->getFirstVariant()->toCurrency('Price'),
                    'priceCurrency' => \Currency\Currency::create()->getCode(),
                ),
                'aggregateRating' => array(
                    '@type' => 'AggregateRating',
                    'ratingValue' => (float) (($aggregateRating['reviewCount']? : 0) / ($aggregateRating['ratingCount']? : 0)),
                    'bestRating' => 5,
                    'worstRating' => 0,
                    'ratingCount' => $aggregateRating['ratingCount']? : 0,
                ),
            );

            if ($model->getBrand()) {
                $Product['brand'] = array(
                    '@type' => 'Brand',
                    'name' => $model->getBrand()->getName(),
                    'logo' => site_url('/uploads/shop/brands/' . $model->getBrand()->getImage()),
                );
            }

            $data = json_encode(array_filter($Product));
            \CMSFactory\assetManager::create()->registerJsScript($data, FALSE, 'after', 'application/ld+json');
        }
    }

}

/* End of file seo_snippets.php */
