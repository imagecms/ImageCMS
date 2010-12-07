<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title}</title>
<meta name="description" content="{$site_description}" />
<meta name="keywords" content="{$site_keywords}" />
<meta name="generator" content="ImageCMS">

<style type="text/css">
    @import "{$SHOP_THEME}style/general.css";
    @import "{$SHOP_THEME}style/product.css";
    @import "{$SHOP_THEME}style/slideshow.css";
</style>

<script type="text/javascript" src="{$SHOP_THEME}js/jquery.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/superfish.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.cycle.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.functions.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/js.js"></script>
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
      <div id="slogan">Приобретайте только качественную технику: <br /> +7 (095) <b>222-33-22</b><br /> +38 (098) <b>222-33-22</b></div>
    </div>
    <div class="right" id="mycart">
        <a href="{shop_url('cart')}" class="items">
            {echo ShopCore::app()->SCart->totalItems()}
            {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array('товар','товара','товаров'))}
        </a>
        <span class="prices">{echo ShopCore::app()->SCart->totalPrice()} {$CS} 
            <a href="{shop_url('cart')}" class="image"><img src="{$SHOP_THEME}style/images/myitems.jpg" width="22" height="18" border="0" alt="mycart" /></a>
        </span>
    </div>

    <div id="topCurrency">
    <form action="" method="post" name="currencyChangeForm">
    {form_csrf()}
        Валюта: <select onchange="document.forms.currencyChangeForm.submit();" name="setCurrency">
            {foreach get_currencies() as $currency}
                <option {if ShopCore::app()->SCurrencyHelper->current->getId() == $currency->getId()}selected{/if} value="{echo $currency->getId()}">{echo encode($currency->getName())}</option>
            {/foreach}
        </select>
    </form>
    </div>

    <div class="sp"></div>
  </div>
  <!-- END HEADER -->
  <!-- BEGIN NAVIGATION -->
  <div id="navigation">
    <ul>
      <li class="home"><a href="/" class="item">Главная</a></li>
      <li><a href="{site_url('about')}" class="item">О Магазине</a> </li>
      <li><a href="{site_url('oplata')}" class="item">Оплата</a> </li>
      <li><a href="{site_url('dostavka')}" class="item">Доставка</a></li>
	  <li><a href="{site_url('help')}" class="item">Помощь</a></li>
	  <li><a href="{site_url('contact_us')}" class="item">Контакты</a></li>
    </ul>
    <!-- BEGIN SEARCH -->
    <div id="search">
      <form action="{shop_url('search')}" method="get">
        <input type="submit" class="submit" value=""/>
        <input type="text" name="text" class="text"/>
      </form>
    </div>
  </div>
  <div id="main">
      <!-- BEGIN CONTEINER -->
    <div id="content">
        {$content} 
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