<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * ImageCMS
 * Seo module
 * Create keywords and description
 */
class Lib_seo {

    protected $orderJustMaked = FALSE;
    public $origin_arr;
    public $modif_arr;
    public $min_word_length = 3;
    public $desc_chars = 160;

    function Lib_seo() {
        if (CI::$APP->session->flashdata('makeOrderForGA') == true) {
            $this->orderJustMaked = TRUE;
        }
    }

    function init($settings) {
        $CI = & get_instance();
        if (!strstr($CI->uri->uri_string(), '/cart/')) {
            $CI->template->registerJsScript($this->renderGA($settings));
        }
        $CI->template->registerJsScript($this->renderYaMetrica($settings), 'after');
        $CI->template->registerJsScript($this->renderYandexWebmaster($settings));
        $CI->template->registerJsScript($this->renderGoogleWebmaster($settings));
    }

    /**
     * Create keywrods from text
     */
    function get_keywords($text, $as_array = FALSE) {
        $text = strip_tags($text);
        $text = mb_strtolower($text, 'utf-8');
        $this->explode_str_on_words($text);
        $this->count_words();
        $arr = array_slice($this->modif_arr, 0, 30);
        $str = "";

        if ($as_array == FALSE) {
            foreach ($arr as $key => $val) {
                $str .= $key . ", ";
            }
            return trim(mb_substr($str, 0, mb_strlen($str, 'utf-8') - 2));
        } else {
            return $arr;
        }
    }

    function get_description($text) {
        $delete = array(';', '"', '&mdash', '&nbsp;');

        $tags = get_html_translation_table(HTML_ENTITIES);

        foreach ($tags as $k => $v) {
            $text = str_replace($v, '', $text);
        }

        $text = str_replace($delete, '', $text);
        $text = str_replace("\n", ' ', $text);
        $text = str_replace("\r", ' ', $text);

        return trim(mb_substr(strip_tags(stripslashes($text)), 0, 255, 'utf-8'));
    }

    /**
     * 	Explode text on words
     */
    function explode_str_on_words($text) {
        $search = array("'ё'",
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
            "'&#(\d+);'e");
        $replace = array("е",
            " ",
            " ",
            "\\1 ",
            "\" ",
            " ",
            " ",
            " ",
            " ",
            chr(161),
            chr(162),
            chr(163),
            chr(169),
            "chr(\\1)");
        $text = preg_replace($search, $replace, $text);
        $del_symbols = array(",", ".", ";", ":", "\"", "#", "\$", "%", "^",
            "!", "@", "`", "~", "*", "-", "=", "+", "\\",
            "|", "/", ">", "<", "(", ")", "&", "?", "¹", "\t",
            "\r", "\n", "{", "}", "[", "]", "'", "“", "”", "•",
            " как ", " для ", " что ", " или ", " это ", " этих ",
            "всех ", " вас ", " они ", " оно ", " еще ", " когда ",
            " где ", " эта ", " лишь ", " уже ", " вам ", " нет ",
            " если ", " надо ", " все ", " так ", " его ", " чем ",
            " даже ", " мне ", " есть ", " раз ", " два ", "raquo", "laquo",
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "mdash"
        );
        $text = str_replace($del_symbols, ' ', $text);
        $text = preg_replace("( +)", " ", $text);
        $this->origin_arr = explode(" ", trim($text));
        return $this->origin_arr;
    }

    /**
     * Count words in text
     */
    function count_words() {
        $tmp_arr = array();
        foreach ($this->origin_arr as $val) {
            if (strlen(utf8_decode($val)) >= $this->min_word_length) {
                $val = mb_strtolower($val, 'utf-8');

                if (array_key_exists($val, $tmp_arr)) {
                    $tmp_arr[$val] ++;
                } else {
                    $tmp_arr[$val] = 1;
                }
            }
        }
//arsort ($tmp_arr);
        $this->modif_arr = $tmp_arr;
    }

    function renderGA($GAid = null) {
        /* Show Google Analytics code if some value inserted in admin panel */

        if ($GAid['google_analytics_id']) {
            $ga = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '" . $GAid['google_analytics_id'] . "', '" . str_replace('www.', '', $_SERVER['HTTP_HOST']) . "');
  ga('send', 'pageview');
  
  ga('require', 'ecommerce', 'ecommerce.js');

</script>";


            return $ga;
        }
    }

    function renderGAForCart($model = null, $GAid = null) {
        $CI = & get_instance();
        /* Show Google Analytics code if some value inserted in admin panel */
        if ($GAid['google_analytics_id']) {
            $ga = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '" . $GAid['google_analytics_id'] . "', '" . str_replace('www.', '', $_SERVER['HTTP_HOST']) . "');
  ga('send', 'pageview');
  
  ga('require', 'ecommerce', 'ecommerce.js');

</script>";
            /* @var $model SOrders */
            if ($model && $this->orderJustMaked) {
                if ($model->getSDeliveryMethods()) {
                    $affiliation = $model->getSDeliveryMethods()->getName();
                }
                $ga .= "
                    <script>
            ga('ecommerce:addTransaction', {
  'id': '" . $model->getId() . "',
  'affiliation': '" . $affiliation . "',
  'revenue': '" . $model->getTotalPrice() . "',
  'shipping': '',
  'tax': '',
});";

                foreach ($model->getSOrderProductss() as $item) {
                    $total = $total + $item->getQuantity() * $item->toCurrency();
                    /* @var $product SProducts */
                    $product = $item->getSProducts();

                    $ga .="ga('ecommerce:addItem', {
    'id': '" . $model->getId() . "',
    'name': '" . encode($product->getName()) . " " . encode($item->getVariantName()) . "',
    'sku': '" . $product->getUrl() . "',
    'category': '" . encode($product->getMainCategory()->getName()) . "',
    'price': '" . $item->toCurrency() . "',
    'quantity': '" . $item->getQuantity() . "',
  });";
                }
                $ga .="ga('ecommerce:send');</script>";
            }


            return $ga;
        }
    }

    function makeOrderForGoogle($model) {
        $CI = & get_instance();
        if ($model && $this->orderJustMaked) {
            $ga = "
                    <script>
            ga('ecommerce:addTransaction', {
  'id': '" . $model->id . "',
  'affiliation': '" . $model->getSDeliveryMethods()->name . "',
  'revenue': '" . $model->getTotalPrice() . "',
  'shipping': '',
  'tax': '',
});";

            foreach ($model->getSOrderProductss() as $item) {
                $total = $total + $item->getQuantity() * $item->toCurrency();
                $product = $item->getSProducts();

                $ga .="ga('ecommerce:addItem', {
    'id': '" . $model->id . "',
    'name': '" . encode($product->getName()) . " " . encode($item->getVariantName()) . "',
    'sku': '" . $product->getUrl() . "',
    'category': '" . encode($product->getMainCategory()->name) . "',
    'price': '" . $item->toCurrency() . "',
    'quantity': '" . $item->getQuantity() . "',
  });";
            }
            $ga .="ga('ecommerce:send');</script>";

            return $ga;
        }
    }

    function renderYaMetrica($YaMetricaId = null) {
        if ($YaMetricaId['yandex_metric']) {
            $YandexMetrik = '<!-- Yandex.Metrika counter -->

                    <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function() {
                            try {
                                w.yaCounter24267703 = new Ya.Metrika({id:' . $YaMetricaId['yandex_metric'] . ',
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

    function renderYandexWebmaster($YaWebmasterId = null) {
        if ($YaWebmasterId['yandex_webmaster'])
            $YaWebmaster = '<meta name=\'yandex-verification\' content=\'' . $YaWebmasterId['yandex_webmaster'] . '\' />';

        return $YaWebmaster;
    }

    function renderGoogleWebmaster($GWebmasterId = null) {
        if ($GWebmasterId['google_webmaster'])
            $GWebmaster = '<meta name="google-site-verification" content="' . $GWebmasterId['google_webmaster'] . '" />';

        return $GWebmaster;
    }

}

/* End of file lib_seo.php */
