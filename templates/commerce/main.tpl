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
    @import "{$SHOP_THEME}style/jquery-ui-1.8.15.custom.css";
    @import "{$SHOP_THEME}style/jquery.ui.autocomplete.css";
</style>

<script type="text/javascript" src="{$SHOP_THEME}js/jquery.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/superfish.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.cycle.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.functions.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/js.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/jquery.coda-bubble.sp.js"></script>
{literal}
<script>
$(function() {
                
		var themeId = $("#callback-dialog-theme"),
                    name = $( "#callback-dialog-name" ),
                    phone = $( "#callback-dialog-phone" ),
                    comment = $( "#callback-dialog-comment" ),
                    allFields = $( [] ).add( themeId ).add( comment ),
                    tips = $( "#callback-dialog-form .validateTips" );

		function updateTips( t ) {
			tips
				.html( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		
                function showGif( t ) {
			tips.html( t );
		}
                
		$( "#callback-dialog-form" ).dialog({
			autoOpen: false,
			width: 350,
			modal: true,
			buttons: {
				"Запросить CallBack" : function() {
					allFields.removeClass( "ui-state-error" );
                                        showGif("<center><img src='/application/modules/imagebox/templates/js/lightbox/images/loading.gif' /></center>");
                                        $.post("/shop/callback", {   ThemeId : themeId.val(),
                                                                     Name : name.val(), 
                                                                     Phone : phone.val(),
                                                                     Comment : comment.val()
                                                                   },
                                                                   function(data) {
                                                                        if (data == "done"){
                                                                                updateTips('Ваш запрос отправлен! В ближайшее время с Вами свяжеться наш менеджер.');
                                                                                setTimeout(function() {
                                                                                        $( "#callback-dialog-form" ).dialog( "close" );
                                                                                }, 2500 );
                                                                        } else updateTips(data);
                                                                   });
				},
				"Отмена" : function() {
					$( this ).dialog( "close" );
				}
			},
                        close: function() {
				allFields.val( "" );
                                tips.html( "" );
			}
		});

		$( "#callback-send-request" )
			.click(function() {
				$( "#callback-dialog-form" ).dialog( "open" );
			});               
	});
	</script>
        <style>
		.ui-dialog, .ui-datepicker { font-size: 82.5%; }
		#dialog-form label input, #callback-dialog-form label input { display:block; }
		#dialog-form input.text,  #callback-dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }
                #callback-dialog-form select { margin-bottom:12px; padding: .4em; width:98.5%; }
		#dialog-form fieldset, #callback-dialog-form fieldset{ padding:0; border:0; margin-top:25px; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em;} 
                }
	</style>
{/literal}
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
    <div class="right" id="mycart" title="Корзина">
        {include_tpl('shop/default/cart_data')} 
    </div>

   {if ShopCore::app()->SWishList->getWishListCookie() && ShopCore::$ci->dx_auth->is_logged_in()} 
   <div class="bubbleInfo">
       <div class="trigger">
           <div class="right" id="mywishlist" title="Wish List">
                {include_tpl('shop/default/wish_list_data')}
           </div>
       </div>
       <div class="popup">
           <div class="wishListQuestion">
               У вас уже был WishList до входа в систему!<br />
                    <a href="{shop_url('wish_list/move_to_profile')}" >Перенести WishList в профиль</a> /
                    <a href="{shop_url('wish_list/clear_cookie_wish_list')}">Удалить WishList</a>
               </div>
           </div>
   </div>    
   {else:}    
   <div class="right" id="mywishlist" title="Wish List">
        {include_tpl('shop/default/wish_list_data')}
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
                Добавлено {count($CI->session->userdata('shopForCompare'))} {echo SStringHelper::Pluralize(count($CI->session->userdata('shopForCompare')), array('товар','товара','товаров'))} для сравнения
            </a>
        </div>
    {/if}

    </div>

    <div class="sp"></div>
    {include_tpl('shop/default/call_back')}
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
