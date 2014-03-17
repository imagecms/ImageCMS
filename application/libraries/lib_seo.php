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
        if (!strstr($CI->uri->uri_string(), '/cart/'))
            $CI->template->registerJsScript($this->renderGA($settings));
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
                    $tmp_arr[$val]++;
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
            $ga = "<script type='text/javascript'>
            var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '" . $GAid['google_analytics_id'] . "']);
          _gaq.push (['_addOrganic', 'images.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'blogs.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'video.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'meta.ua', 'q']);
          _gaq.push (['_addOrganic', 'search.bigmir.net', 'z']);
          _gaq.push (['_addOrganic', 'search.i.ua', 'q']);
          _gaq.push (['_addOrganic', 'mail.ru', 'q']);
          _gaq.push (['_addOrganic', 'go.mail.ru', 'q']);
          _gaq.push (['_addOrganic', 'google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'images.google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'maps.google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'images.google.ru', 'q']);
          _gaq.push (['_addOrganic', 'maps.google.ru', 'q']);
          _gaq.push (['_addOrganic', 'rambler.ru', 'words']);
          _gaq.push (['_addOrganic', 'nova.rambler.ru', 'query']);
          _gaq.push (['_addOrganic', 'nova.rambler.ru', 'words']);
          _gaq.push (['_addOrganic', 'gogo.ru', 'q']);
          _gaq.push (['_addOrganic', 'nigma.ru', 's']);
          _gaq.push (['_addOrganic', 'poisk.ru', 'text']);
          _gaq.push (['_addOrganic', 'go.km.ru', 'sq']);
          _gaq.push (['_addOrganic', 'liveinternet.ru', 'ask']);
          _gaq.push (['_addOrganic', 'gde.ru', 'keywords']);
          _gaq.push (['_addOrganic', 'search.qip.ru', 'query']);
          _gaq.push (['_addOrganic', 'webalta.ru', 'q']);
          _gaq.push (['_addOrganic', 'sm.aport.ru', 'r']);
          _gaq.push (['_addOrganic', 'index.online.ua', 'q']);
          _gaq.push (['_addOrganic', 'web20.a.ua', 'query']);
          _gaq.push (['_addOrganic', 'search.ukr.net', 'search_query']);
          _gaq.push (['_addOrganic', 'search.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'search.ua', 'q']);
          _gaq.push (['_addOrganic', 'affiliates.quintura.com', 'request']);
          _gaq.push (['_addOrganic', 'akavita.by', 'z']);
          _gaq.push (['_addOrganic', 'search.tut.by', 'query']);
          _gaq.push (['_addOrganic', 'all.by', 'query']);
          _gaq.push(['_trackPageview']);
        </script>";

            $ga .= "
<script type = 'text/javascript'>
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>";
            return $ga;
        }
    }

    function renderGAForCart($model = null, $GAid = null) {
        $CI = & get_instance();
        /* Show Google Analytics code if some value inserted in admin panel */
        if ($GAid['google_analytics_id']) {
            $ga = "<script type='text/javascript'>
            var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '" . $GAid['google_analytics_id'] . "']);
          _gaq.push (['_addOrganic', 'images.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'blogs.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'video.yandex.ru', 'text']);
          _gaq.push (['_addOrganic', 'meta.ua', 'q']);
          _gaq.push (['_addOrganic', 'search.bigmir.net', 'z']);
          _gaq.push (['_addOrganic', 'search.i.ua', 'q']);
          _gaq.push (['_addOrganic', 'mail.ru', 'q']);
          _gaq.push (['_addOrganic', 'go.mail.ru', 'q']);
          _gaq.push (['_addOrganic', 'google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'images.google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'maps.google.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'images.google.ru', 'q']);
          _gaq.push (['_addOrganic', 'maps.google.ru', 'q']);
          _gaq.push (['_addOrganic', 'rambler.ru', 'words']);
          _gaq.push (['_addOrganic', 'nova.rambler.ru', 'query']);
          _gaq.push (['_addOrganic', 'nova.rambler.ru', 'words']);
          _gaq.push (['_addOrganic', 'gogo.ru', 'q']);
          _gaq.push (['_addOrganic', 'nigma.ru', 's']);
          _gaq.push (['_addOrganic', 'poisk.ru', 'text']);
          _gaq.push (['_addOrganic', 'go.km.ru', 'sq']);
          _gaq.push (['_addOrganic', 'liveinternet.ru', 'ask']);
          _gaq.push (['_addOrganic', 'gde.ru', 'keywords']);
          _gaq.push (['_addOrganic', 'search.qip.ru', 'query']);
          _gaq.push (['_addOrganic', 'webalta.ru', 'q']);
          _gaq.push (['_addOrganic', 'sm.aport.ru', 'r']);
          _gaq.push (['_addOrganic', 'index.online.ua', 'q']);
          _gaq.push (['_addOrganic', 'web20.a.ua', 'query']);
          _gaq.push (['_addOrganic', 'search.ukr.net', 'search_query']);
          _gaq.push (['_addOrganic', 'search.com.ua', 'q']);
          _gaq.push (['_addOrganic', 'search.ua', 'q']);
          _gaq.push (['_addOrganic', 'affiliates.quintura.com', 'request']);
          _gaq.push (['_addOrganic', 'akavita.by', 'z']);
          _gaq.push (['_addOrganic', 'search.tut.by', 'query']);
          _gaq.push (['_addOrganic', 'all.by', 'query']);
          _gaq.push(['_trackPageview']);
        </script>";
            if ($model && $this->orderJustMaked) {
                $ga .= "
                    <script type='text/javascript'>
            _gaq.push(['_addTrans',
                '" . $model->id . "',
                '',
                '" . $model->getTotalPrice() . "',
                '',
                '" . $model->getSDeliveryMethods()->name . "',
                '',
                '',
                ''
            ]);";

                foreach ($model->getSOrderProductss() as $item) {
                    $total = $total + $item->getQuantity() * $item->toCurrency();
                    $product = $item->getSProducts();

                    $ga .="_gaq.push(['_addItem',
                '" . $model->id . "',
                '" . $product->getUrl() . "',
                '" . encode($product->getName()) . " " . encode($item->getVariantName()) . "',
                '" . encode($product->getMainCategory()->name) . "',
                '" . $item->toCurrency() . "',
                '" . $item->getQuantity() . "']);";
                }
                $ga .="_gaq.push(['_trackTrans']);</script>";
            }

            $ga .= "
<script type = 'text/javascript'>
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>";
            return $ga;
        }
    }

    function makeOrderForGoogle($model) {
        $CI = & get_instance();
        if ($model && $this->orderJustMaked) {
            $ga = "
                    <script type='text/javascript'>
            _gaq.push(['_addTrans',
                '" . $model->id . "',
                '',
                '" . $model->getTotalPrice() . "',
                '',
                '" . $model->getSDeliveryMethods()->name . "',
                '',
                '',
                ''
            ]);";

            foreach ($model->getSOrderProductss() as $item) {
                $total = $total + $item->getQuantity() * $item->toCurrency();
                $product = $item->getSProducts();

                $ga .="_gaq.push(['_addItem',
                '" . $model->id . "',
                '" . $product->getUrl() . "',
                '" . encode($product->getName()) . " " . encode($item->getVariantName()) . "',
                '" . encode($product->getMainCategory()->name) . "',
                '" . $item->toCurrency() . "',
                '" . $item->getQuantity() . "']);";
            }
            $ga .="_gaq.push(['_trackTrans']);</script>";

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
            $YaWebmaster = '<meta name="yandex-verification" content="' . $YaWebmasterId['yandex_webmaster'] . '" />';

        return $YaWebmaster;
    }

    function renderGoogleWebmaster($GWebmasterId = null) {
        if ($GWebmasterId['google_webmaster'])
            $GWebmaster = '<meta name="google-site-verification" content="' . $GWebmasterId['google_webmaster'] . '" />';

        return $GWebmaster;
    }

}

/* End of file lib_seo.php */
