<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * ImageCMS
 * Seo module
 * Create keywords and description
 */
class Lib_seo
{

    /**
     * @var bool
     */
    protected $orderJustMacked = FALSE;

    /**
     * @var array
     */
    public $origin_arr;

    /**
     * @var array
     */
    public $modif_arr;

    /**
     * @var int
     */
    public $min_word_length = 3;

    /**
     * @var int
     */
    public $desc_chars = 160;

    /**
     * GA custom params
     * @var array
     */
    private $custom = [];

    /**
     * Lib_seo constructor.
     */
    public function __construct() {

        if (CI::$APP->session->flashdata('makeOrderForGA') == true) {
            $this->orderJustMacked = TRUE;
        }

        CI::$APP->load->library('DX_Auth');

        if (CI::$APP->dx_auth->is_logged_in()) {
            $this->setCustomParams('userId', md5(CI::$APP->dx_auth->get_user_id()));
        }
    }

    /**
     * @param array $settings
     */
    public function init($settings) {

        $CI = &get_instance();
        if (!strstr($CI->uri->uri_string(), 'shop/order/view')) {
            $CI->template->registerJsScript($this->renderGA($settings));
        }
        $CI->template->registerJsScript($this->renderYaMetrica($settings), 'after');
        $CI->template->registerJsScript($this->renderYandexWebmaster($settings));
        $CI->template->registerJsScript($this->renderGoogleWebmaster($settings));
    }

    /**
     * Create keywords from text
     * @param string $text
     * @param bool $as_array
     * @return array|string
     */
    public function get_keywords($text, $as_array = FALSE) {

        $text = strip_tags($text);
        $text = mb_strtolower($text, 'utf-8');
        $this->explode_str_on_words($text);
        $this->count_words();
        $arr = array_slice($this->modif_arr, 0, 30);

        if ($as_array === FALSE) {
            return implode(', ', array_keys($arr));
        } else {
            return $arr;
        }
    }

    /**
     * @param string $text
     * @return string
     */
    public function get_description($text) {

        $delete = [
                   ';',
                   '"',
                   '&mdash',
                   '&nbsp;',
                  ];

        $tags = get_html_translation_table(HTML_ENTITIES);

        foreach ($tags as $v) {
            $text = str_replace($v, '', $text);
        }

        $text = str_replace($delete, '', $text);
        $text = str_replace("\n", ' ', $text);
        $text = str_replace("\r", ' ', $text);

        return trim(mb_substr(strip_tags(stripslashes($text)), 0, 255, 'utf-8'));
    }

    /**
     * Explode text on words
     * @param string $text
     * @return array
     */
    public function explode_str_on_words($text) {

        $search = [
                   "'ё'",
                   "'<script[^>]*?>.*?</script>'si",
                   "'<[\/\!]*?[^<>]*?>'si",
                   "'([\r\n])[\s]+'",
                   "'&(quot|#34);'i",
                   "'&(amp|#38);'i",
                   "'&(lt|#60);'i",
                   "'&(gt|#62);'i",
                   "'&(nbsp|#160);'i",
                   "'&(iexcl|#161);'i",
                   "'&(cent|#162);'i",
                   "'&(pound|#163);'i",
                   "'&(copy|#169);'i",
                   "'&#(\d+);'i",
                  ];
        $replace = [
                    'е',
                    ' ',
                    ' ',
                    '\\1 ',
                    '" ',
                    ' ',
                    ' ',
                    ' ',
                    ' ',
                    chr(161),
                    chr(162),
                    chr(163),
                    chr(169),
                    'chr(\\1)',
                   ];

        $text = preg_replace($search, $replace, $text);
        $del_symbols = [
                        ',',
                        '.',
                        ';',
                        ':',
                        '"',
                        '#',
                        '\$',
                        '%',
                        '^',
                        '!',
                        '@',
                        '`',
                        '~',
                        '*',
                        '-',
                        '=',
                        '+',
                        '\\',
                        '|',
                        '/',
                        '>',
                        '<',
                        '(',
                        ')',
                        '&',
                        '?',
                        '¹',
                        "\t",
                        "\r",
                        "\n",
                        '{',
                        '}',
                        '[',
                        ']',
                        "'",
                        '“',
                        '”',
                        '•',
                        ' как ',
                        ' для ',
                        ' что ',
                        ' или ',
                        ' это ',
                        ' этих ',
                        'всех ',
                        ' вас ',
                        ' они ',
                        ' оно ',
                        ' еще ',
                        ' когда ',
                        ' где ',
                        ' эта ',
                        ' лишь ',
                        ' уже ',
                        ' вам ',
                        ' нет ',
                        ' если ',
                        ' надо ',
                        ' все ',
                        ' так ',
                        ' его ',
                        ' чем ',
                        ' даже ',
                        ' мне ',
                        ' есть ',
                        ' раз ',
                        ' два ',
                        'raquo',
                        'laquo',
                        '0',
                        '1',
                        '2',
                        '3',
                        '4',
                        '5',
                        '6',
                        '7',
                        '8',
                        '9',
                        'mdash',
                       ];
        $text = str_replace($del_symbols, ' ', $text);
        $text = preg_replace('( +)', ' ', $text);
        $this->origin_arr = explode(' ', trim($text));
        return $this->origin_arr;
    }

    /**
     * Count words in text
     */
    public function count_words() {

        $tmp_arr = [];
        foreach ($this->origin_arr as $val) {
            if (strlen(utf8_decode($val)) >= $this->min_word_length) {
                $val = mb_strtolower($val, 'utf-8');

                if (array_key_exists($val, $tmp_arr)) {
                    $tmp_arr[$val]++;
                } else {
                    $tmp_arr[$val] = 1;
                }
            }
        }
        $this->modif_arr = $tmp_arr;
    }

    /**
     * @param null|string $GAid
     * @return string
     */
    public function renderGA($GAid = null) {

        /* Show Google Analytics code if some value inserted in admin panel */
        if ($GAid['google_analytics_id']) {
            if ($this->getCustomParams()) {
                $custom = ', ' . $this->getCustomParams();
            }

            if ($GAid['google_analytics_ee'] == 1) {
                $require = "ga('require', 'ec');";
            } else {
                $require = "ga('require', 'ecommerce', 'ecommerce.js');";
            }
            $ga = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{$GAid['google_analytics_id']}', 'auto' $custom);
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
  
  $require

</script>";

            return $ga;
        }
    }

    /**
     * @param null|SProducts $model
     * @param null|string $GAid
     * @return string
     */
    public function renderGAForCart($model = null, $GAid = null) {

        /* Show Google Analytics code if some value inserted in admin panel */
        if ($GAid['google_analytics_id']) {
            if ($this->getCustomParams()) {
                $custom = ', ' . $this->getCustomParams();
            }
            $require = $GAid['google_analytics_ee'] == '1' ? "ga('require', 'ec');" : "ga('require', 'ecommerce', 'ecommerce.js');";

            $ga = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{$GAid['google_analytics_id']}', 'auto' $custom);
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
  
  $require";
            /* @var $model SOrders */
            if ($model && $this->orderJustMacked && $GAid['google_analytics_ee'] !== '1') {
                if ($model->getSDeliveryMethods()) {
                    $affiliation = $model->getSDeliveryMethods()->getName();
                }
                $ga .= "
            ga('ecommerce:addTransaction', {
  'id': '" . $model->getId() . "',
  'affiliation': '" . $affiliation . "',
  'revenue': '" . $model->getTotalPrice() . "',
  'shipping': '',
  'tax': '',
});";

                foreach ($model->getSOrderProductss() as $item) {
                    /* @var $product SProducts */
                    $product = $item->getSProducts();
                    foreach ($product->getProductVariants() as $v) {
                        if ($v->getid() == $item->getVariantId()) {
                            $Variant = $v;
                            break;
                        }
                    }
                    $ga .= "ga('ecommerce:addItem', {
    'id': '" . $model->getId() . "',
    'name': '" . encode($product->getName()) . ' ' . encode($item->getVariantName()) . "',
    'sku': '" . encode($Variant->getNumber()) . "',
    'category': '" . encode($product->getMainCategory()->getName()) . "',
    'price': '" . $item->toCurrency() . "',
    'quantity': '" . $item->getQuantity() . "',
  });";
                }
                $ga .= "ga('ecommerce:send');";
            }
            $ga .= '</script>';

            return $ga;
        }
    }

    /**
     * @param null|string $YaMetricaId
     * @return string
     */
    public function renderYaMetrica($YaMetricaId = null) {

        $YandexMetrik = '';
        if ($YaMetricaId['yandex_metric']) {
            $YandexMetrik = '<!-- Yandex.Metrika counter -->

                    <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function() {
                            try {
                                w.yaCounter' . $YaMetricaId['yandex_metric'] . ' = new Ya.Metrika({id:"' . $YaMetricaId['yandex_metric'] . '",
                                        webvisor:true,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true});
                            } catch(e) { }
                        });

                        var n = d.getElementsByTagName("script")[0],
                            s = d.createElement("script"),
                            f = function () { n.parentNode.insertBefore(s, n); };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else { f(); }
                    })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="//mc.yandex.ru/watch/' . $YaMetricaId['yandex_metric'] . '" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->';
        }
        return $YandexMetrik;
    }

    public function renderYandexWebmaster($YaWebmasterId = null) {

        $YaWebmaster = '';
        if ($YaWebmasterId['yandex_webmaster']) {
            $YaWebmaster = '<meta name=\'yandex-verification\' content=\'' . $YaWebmasterId['yandex_webmaster'] . '\' />';
        }

        return $YaWebmaster;
    }

    public function renderGoogleWebmaster($GWebmasterId = null) {

        $GWebmaster = '';
        if ($GWebmasterId['google_webmaster']) {
            $GWebmaster = '<meta name="google-site-verification" content="' . $GWebmasterId['google_webmaster'] . '" />';
        }

        return $GWebmaster;
    }

    public function getCustomParams($type = 'json') {

        if (empty($this->custom)) {
            return;
        }
        switch ($type) {
            case 'json':
                return json_encode($this->custom);

            default:
                return $this->custom;
        }
    }

    /**
     * @param string $name
     * @param string $val
     */
    public function setCustomParams($name, $val) {

        if ($name != '') {
            $this->custom[$name] = $val;
        }
    }

}

/* End of file lib_seo.php */