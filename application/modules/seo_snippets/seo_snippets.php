<?php

use CMSFactory\assetManager;
use CMSFactory\Events;
use Currency\Currency;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Seo snippets module
 * @author Gula Andriy <a.gula@imagecms.net>
 * @copyright (c) 2015, Gula Andriy
 * @version 1.1
 *
 * @property Seo_snippets_model $seo_snippets_model
 * @property Cms_base cms_base
 */
class Seo_snippets extends MY_Controller
{

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
        Events::create()->onProductPageLoad()
                ->setListener('makeProductSnippet');

        $this->settings = $this->cms_base->get_settings();

        $WebSite = $this->makeWebSiteSnippet();
        $LocalBusiness = $this->makeLocalBusinessSnippet();

        $data = json_encode(array_filter([$LocalBusiness, $WebSite]));

        assetManager::create()->registerJsScript($data, FALSE, 'after', 'application/ld+json');
    }

    public function _install() {
        $this->db->where('name', 'seo_snippets')
            ->update('components', ['autoload' => '1', 'enabled' => '1']);
    }

    public function _deinstall() {

    }

    private function makeLocalBusinessSnippet() {
        $LocalBusiness = [
                          '@context'  => 'http://schema.org',
                          '@type'     => 'LocalBusiness',
                          'name'      => $this->settings['site_title'],
                          'image'     => site_url(siteinfo('siteinfo_logo_url')),
                          'telephone' => siteinfo('siteinfo_mainphone'),
                          'email'     => siteinfo('Email'),
                          'address'   => [
                                          '@type'         => 'PostalAddress',
                                          'streetAddress' => siteinfo('siteinfo_address'),
                                         ],
                          'url'       => site_url(),
                         ];
        return $LocalBusiness;
    }

    private function makeWebSiteSnippet() {
        $WebSite = [
                    '@context'        => 'http://schema.org',
                    '@type'           => 'WebSite',
                    'name'            => $this->settings['site_short_title'],
                    'alternateName'   => $this->settings['site_title'],
                    'url'             => site_url(),
                    'potentialAction' => [
                                          '@type'       => 'SearchAction',
                                          'target'      => site_url('shop/search?text={search_term_string}'),
                                          'query-input' => 'required name=search_term_string',
                                         ],
                   ];
        return $WebSite;
    }

    /**
     *
     * @param array $product
     */
    public static function makeProductSnippet($product) {
        $review = [];
        $similar = [];

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
            $similarProducts = getSimilarProduct($model);

            /* @var $similarProduct SProducts */
            foreach ($similarProducts as $similarProduct) {
                $similar[] = [
                              'url'   => shop_url('product/' . $similarProduct->getUrl()),
                              'image' => site_url($similarProduct->getFirstVariant()->getMainPhoto()),
                             ];
            }

            CI::$APP->load->module('comments')->load->model('base');
            $comments = CI::$APP->base->get($model->getId(), 0, 'shop');

            foreach ($comments as $comment) {
                $review[] = [
                             '@type'         => 'Review',
                             'author'        => $comment['user_name'],
                             'datePublished' => gmdate('D, d M Y\G\M\T', $comment['date']),
                             'description'   => $comment['text'],
                             'reviewRating'  => [
                                                 '@type'       => 'Rating',
                                                 'bestRating'  => '5',
                                                 'ratingValue' => $comment['rate'],
                                                 'worstRating' => 0,
                                                ],
                            ];
            }
            $Product = [
                        '@context'        => 'http://schema.org',
                        '@type'           => 'Product',
                        'name'            => $name,
                        'image'           => site_url($model->getFirstVariant()->getMainPhoto()),
                        'description'     => mb_substr(strip_tags($model->getFullDescription()), 0, 200, 'utf-8'),
                        'url'             => shop_url('product/' . $model->getUrl()),
                        'brand'           => [],
                        'offers'          => [
                                              '@type'         => 'Offer',
                                              'availability'  => $model->getFirstVariant()->getStock() > 0 ? 'http://schema.org/InStock' : 'http://schema.org/SoldOut',
                                              'price'         => $model->getFirstVariant()->toCurrency('Price'),
                                              'priceCurrency' => Currency::create()->getCode(),
                                             ],
                        'isSimilarTo'     => $similar,
                        'aggregateRating' => [
                                              '@type'       => 'AggregateRating',
                                              'ratingValue' => (float) (($aggregateRating['reviewCount'] ? : 0) / ($aggregateRating['ratingCount'] ? : 0)),
                                              'bestRating'  => 5,
                                              'worstRating' => 0,
                                              'ratingCount' => $aggregateRating['ratingCount'] ? : 0,
                                             ],
                        'review'          => $review,
                       ];

            if ($model->getBrand()) {
                $Product['brand'] = [
                                     '@type' => 'Brand',
                                     'name'  => $model->getBrand()->getName(),
                                     'logo'  => site_url('/uploads/shop/brands/' . $model->getBrand()->getImage()),
                                    ];
            }

            $data = json_encode(array_filter($Product));
            assetManager::create()->registerJsScript($data, FALSE, 'after', 'application/ld+json');
        }
    }

}

/* End of file seo_snippets.php */