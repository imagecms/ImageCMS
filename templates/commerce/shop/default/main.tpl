<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title}</title>
<meta name="description" content="{$site_description}" />
<meta name="keywords" content="{$site_keywords}" />
<meta name="generator" content="ImageCMS" />

{literal}
<script type="text/javascript">
    var currencySymbol = {/literal}'{$CS}'{literal};
</script>
{/literal}

<style type="text/css">
    @import "{$SHOP_THEME}style/jquery-ui-1.8.15.custom.css";
    @import "{$SHOP_THEME}style/jquery.ui.autocomplete.css";
    @import "{$SHOP_THEME}style/general.css";
    @import "{$SHOP_THEME}style/product.css";
    @import "{$SHOP_THEME}style/slideshow.css";
    @import "{$SHOP_THEME}style/ie7/skin.css";
</style>

<script type="text/javascript" src="{$SHOP_THEME}js/jquery.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/superfish.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.cycle.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.functions.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/js.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.coda-bubble.sp.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/main.js"></script>

<link rel="icon" href="{$SHOP_THEME}images/favicon.png" type="image/x-icon" />
</head>
<body>
<!-- BEGIN LAYOUT -->
<div id="conteiner">
  <!-- BEGIN HEADER -->
  <div id="header">
    <div class="left">
      <!-- BEGIN LOGO -->
      <div id="logo"><a href="{shop_url('')}"><img src="{$SHOP_THEME}images/logo.png" alt="logo" border="0"/></a></div>
      <!-- BEGIN SLOGAN -->
     <div id="slogan">Приобретайте только качественную технику: <br /> +7 (095) <b>222-33-22</b><br /> +38 (098) <b>222-33-22</b><br /><a id="callback-send-request" style="cursor: pointer;">Запросить CallBack</a></div>
    </div>

    <!-- Hold this part in separate file which will be used for ajax requests. -->
    <div class="right" id="mycart" title="Корзина">
        {include_tpl('cart_data')}
    </div>

    {if ShopCore::app()->SWishList->getWishListCookie() && ShopCore::$ci->dx_auth->is_logged_in()}
   <div class="bubbleInfo">
       <div class="trigger">
           <div class="right" id="mywishlist" title="Wish List">
                {include_tpl('wish_list_data')}
           </div>
       </div>
       <div class="popup">
           <div class="wishListQuestion">
               У вас уже был WishList до входа в систему!<br />
                    <a rel="nofollow" href="{shop_url('wish_list/move_to_profile')}" >Перенести WishList в профиль</a> /
                    <a rel="nofollow" href="{shop_url('wish_list/clear_cookie_wish_list')}">Удалить WishList</a>
               </div>
           </div>
   </div>
   {else:}
   <div class="right" id="mywishlist" title="Wish List">
        {include_tpl('wish_list_data')}
   </div>
   {/if}

    <div id="topCurrency" align="right">
    <form action="" method="post" name="currencyChangeForm">
    {form_csrf()}
        Валюта: <select onchange="document.forms.currencyChangeForm.submit();" name="setCurrency">
            {foreach get_currencies() as $currency}
                <option {if ShopCore::app()->SCurrencyHelper->current->getId() == $currency->getId()}selected{/if} value="{echo $currency->getId()}">{echo encode($currency->getName())}</option>
            {/foreach}
        </select>
    </form>

    {if $CI->session->userdata('shopForCompare')}
        <div class="topCompareInfo">
            <a href="{shop_url('compare')}">
                Добавлено {count($CI->session->userdata('shopForCompare'))} {echo SStringHelper::Pluralize(count($CI->session->userdata('shopForCompare')), 'товар', 'товара', 'товаров' ))} для сравнения
            </a>
        </div>
    {/if}
    </div>

   <div class="sp"></div>
{include_tpl('call_back')}
  </div>
  <!-- END HEADER -->
  <!-- BEGIN NAVIGATION -->
  <div id="navigation">
    {load_menu('main_menu')}
    <!-- BEGIN SEARCH -->
    <div id="search">
      <form action="{shop_url('search')}" method="get">
        <input type="submit" class="submit" value=""/>
        <input type="text" name="text" class="text" id="text"/>
      </form>
    </div>
  </div>
  <div id="main">
      <!-- BEGIN CONTEINER -->
    <div id="content">
        {$shop_content}
    </div>
    <!-- END CONTENT -->
    <div class="sp"></div>
  </div>
  <div class="sp"></div>
</div>
<!-- BEGIN FOOTER -->
<div id="footer">
  <div class="left">© 2011  Ваш <strong>Интернет-магазин</strong><br/>
    <div class="credits"> Powered by <a href="http://www.imagecms.net">ImageCMS Shop</a></div>
  </div>
  <ul class="right">
      <li><a href="{site_url('about')}" class="item">О Магазине</a> </li>
      <li><a href="{site_url('oplata')}" class="item">Оплата</a> </li>
      <li><a href="{site_url('dostavka')}" class="item">Доставка</a></li>
	  <li><a href="{site_url('help')}" class="item">Помощь</a></li>
	  <li><a href="{site_url('contact_us')}" class="item">Контакты</a></li>
  </ul>
  <div class="sp"></div>
</div>
<!-- END FOOTER -->
</body>
</html>
