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
      <div id="logo"><a href="index.html"><img src="{$SHOP_THEME}style/images/logo.png" alt="logo" border="0"/></a></div>
      <!-- BEGIN SLOGAN -->
      <div id="slogan">Ваш <b>магазин</b> слоган</div>
    </div>
    <div class="right" id="mycart">
        <a href="{shop_url('cart')}" class="items">{echo ShopCore::app()->SCart->totalItems()} item</a>
        <span class="prices">$ {echo ShopCore::app()->SCart->totalPrice()} 
            <a href="{shop_url('cart')}" class="image"><img src="{$SHOP_THEME}style/images/myitems.jpg" width="22" height="18" border="0" alt="mycart" /></a>
        </span>
    </div>
    <div class="sp"></div>
  </div>
  <!-- END HEADER -->
  <!-- BEGIN NAVIGATION -->
  <div id="navigation">
    <ul>
      <li class="home"><a href="index.html" class="item">Главная</a></li>
      <li><a href="product.html" class="item">PRODUCT</a> </li>
      <li><a href="category.html" class="item">PAGE CATEGORY</a> </li>
      <li><a href="#" class="item">SUB CATEGORY</a>
        <ul class="hover">
          <li><a href="category.html">Lapsum hirem there</a></li>
          <li><a href="category.html">Categoria quirem mure</a></li>
          <li><a href="category.html">Polurem comput fuler</a></li>
          <li><a href="category.html">Lapsum irem trou</a></li>
          <li><a href="category.html">Selfed trio pollon</a></li>
          <li><a href="category.html">Numen est lapsum hirem</a></li>
        </ul>
      </li>
      <li><a href="contact.html" class="item">CONTACT US</a></li>
    </ul>
    <!-- BEGIN SEARCH -->
    <div id="search">
      <form action="#">
        <input type="submit" class="submit" value=""/>
        <input type="text" class="text"/>
        {form_csrf()}
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
  <div class="left">© 2010  Your site <strong>oxo ecommerce</strong> .com<br/>
    <div class="credits"> Credits by <strong>Aldema Studio</strong></div>
  </div>
  <ul class="right">
    <li><a href="#">Home</a></li>
    <li><a href="#">Feed RSS</a></li>
    <li><a href="#">Sitemap</a></li>
    <li class="last"><a href="#">Contact</a></li>
  </ul>
  <div class="sp"></div>
</div>
<!-- END FOOTER -->
</body>
</html>
