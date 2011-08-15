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

<link rel="icon" href="{$SHOP_THEME}images/favicon.png" type="image/x-icon" />
{literal}
	<script>
        $(function() {
		$( "#text" ).autocomplete({
			source: "/shop/search",
			minLength: 2,
                        select: function( event, ui ) {
				return false;
			},
                        open: function(event, ui){
                            return false;
                        }
		})
                .data( "autocomplete" )._renderItem = function( ul, item ) { {/literal}
                        var currencySymbol = '{$CS}';{literal}
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a  onclick=\"window.location = '" + item.url + "';\">" + item.label + "<br>"  + "<img src=\"/uploads/shop/" + item.image + "\" alt=\"image\" border=\"0\">" 
                                          + "<div class=\"price\">Цена:" + item.price + " " +currencySymbol +"</div>" +"</a>" )
				.appendTo( ul );
		};
	});
	</script>

	<style>
		.ui-dialog, .ui-datepicker { font-size: 82.5%; }
		#dialog-form label input { display:block; }
		#dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }
		#dialog-form fieldset { padding:0; border:0; margin-top:25px; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em;} 
                }
	</style>
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#actual" ).datepicker({minDate: new Date() });
                $( "#actual" ).datepicker( "option", "dateFormat", 'dd-mm-yy');
                
		var productId = $( "[name=productId]" ),
                    variantId = $( "[name=variantId]" ),
                    name = $( "#name" ),
                    email = $( "#email" ),
                    phone = $( "#phone" ),
                    actual = $( "#actual" ),
                    comment = $( "#comment" ),
                    allFields = $( [] ).add( name ).add( email ).add( phone ).add( actual ).add( comment ),
                    tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.html( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			width: 350,
			modal: true,
			buttons: {
				"Сообщить о появлении" : function() {
					allFields.removeClass( "ui-state-error" );
                                        $.post("/shop/cart/sendNotifyingRequest", {productId: productId.val(),
                                                                     variantId: variantId.val(),
                                                                     name: name.val(), 
                                                                     email: email.val(), 
                                                                     phone: phone.val(),
                                                                     actual:actual.val(),
                                                                     comment:comment.val()
                                                                   },
                                                                   function(data) {
                                                                        if (data == "done"){
                                                                                updateTips('Ваш запрос отправлен!');
                                                                                setTimeout(function() {
                                                                                        $( "#dialog-form" ).dialog( "close" );
                                                                                }, 1000 );
                                                                        } else updateTips(data);
                                                                   });
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
                        close: function() {
				allFields.val( "" );
                                tips.html( "" );
			}
		});

		$( "#send-request" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});               
	});
	</script>
{/literal}
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
                    <a href="{shop_url('wish_list/move_to_profile')}" >Перенести WishList в профиль</a> /
                    <a href="{shop_url('wish_list/clear_cookie_wish_list')}">Удалить WishList</a>
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
                Добавлено {count($CI->session->userdata('shopForCompare'))} {echo SStringHelper::Pluralize(count($CI->session->userdata('shopForCompare')), array('товар','товара','товаров'))} для сравнения
            </a>
        </div>
    {/if}

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
