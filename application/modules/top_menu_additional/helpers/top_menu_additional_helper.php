<?php
if (!function_exists('get_prod_name')){
    function get_prod_name($id, $what = 'name'){
        $prod = SProductsQuery::create()->findPk($id);
        if ($prod){
            if ($what == 'name')
                return $prod->getname();
            else
                return $prod->getUrl();
        } else return false;
    }
}
if (!function_exists('get_url')){
    function get_url($res, $prod){
        $res_id = $res['id'];
        foreach ($prod as $p){
            if ($res_id == $p['id_res'])
                return $p['url'];
        }
        
        return lang('--значение не определено--', 'top_menu_additional');
    }
}


