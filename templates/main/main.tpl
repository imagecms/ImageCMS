<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title}</title>
<link href="{$THEME}/css/style.css" type="text/css" rel="stylesheet" />
<link href="{$THEME}/css/forms.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="all">

<div class="topleft">

	<ul>
    	<li><a href="{site_url('')}">Главная</a></li>
        <li><a href="{site_url('contacts')}">Контакты</a></li>
        <li><a href="{site_url('sitemap')}">Карта сайта</a></li>
	</ul>
    
    <div class="logo"><a href="{site_url()}"><img src="{$THEME}/images/logo.jpg" /></a></div>
    
</div>

<div class="toprobots"></div>

<div class="topright">
            <form action="{site_url('search')}" method="post">
            	<p>поиск</p>
            	<p id="searchfield"><input type="text" value="" name="text" /></p>
            	<p><input type="image" src="{$THEME}/images/search_submit.gif" /></p>
             {form_csrf()}
            </form>
<div class="login_cart">
    <div class="cart">
    	<h2>Корзина</h2>
        <p>
        	всего товаров: <a class="whitelink" href="{site_url('simple_cart')}">{cart_total_items()}</a><br/>
            общая стоимость: <a class="whitelink" href="{site_url('simple_cart')}">{cart_total_price()} $</a><br/>
            <a href="{site_url('simple_cart')}">перейти в корзину</a>
        </p>
    </div>
    <div class="login">
    	<h2>Личный кабинет</h2>
        {if $is_logged_in}
            <p style="font-weight:normal;width:190px;">
                Здравствуйте, {$username}.
                <br />
                <br />
                <a href="{site_url('auth/logout')}">Выход</a>
            </p>
        {else:}
        <span>(только для людей)</span><br />
        <form action="{site_url('auth/login')}" method="post" name="login_form">
            <p>Логин</p><p id="loginfield"><input type="text" name="username" /></p>
            <div class="clear"></div>
            <p>Пароль</p><p id="loginfield"><input type="password" name="password" /></p>
            <div class="clear"></div>
            <div class="enter"><a href="javascript:document.forms.login_form.submit();" type="submit">Войти</a></div>
            <div class="forgot"><a href="{site_url('auth/register')}">Регистрация</a></div>
            {form_csrf()}
        </form>
        {/if}
    </div>
</div><!-- login_cart END -->
</div><!-- topright END -->
<div class="clear"></div>

<div class="mainmenu">

{load_menu('main_menu')}
   
</div><!-- mainmenu END -->

<div class="mainbody">


	<div class="left">

    	<h2>Категории продукции</h2>
        {load_menu('left_menu')}	
        
        <h2>Категории статей</h2>
        {load_menu('articles', 'ol')}	
          
    </div><!-- left END -->
    
    <div class="right">
    <!-- CONTENT -->
        {$content}
    <!-- CONTENT END -->
    </div><!-- right END -->
</div><!-- mainbody END -->

<div class="footer">
	<div class="live"><img src="{$THEME}/images/live.jpg" /></div>
    <div class="copy"><a href="http://www.imagecms.net">Сайт работает на ImageCMS</a><br/><br/></div>
    	<ul>
        	<li><a href="#">Главная</a></li>
            <li><a href="#">Продукт</a></li>
            <li><a href="#">Разработка</a></li>
            <li><a href="#">Примеры</a></li>
            <li><a href="#">Поддержка</a></li>
        </ul>

        <ul class="sysinfo">
            <li>
               Время выполнения: { echo $CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end')}
            </li>
            <li>
               Запросов к БД: { echo $CI->db->total_queries()} 
            </li>
            <li>
               Потребление памяти: { echo round(memory_get_usage()/1024/1024, 3)} Мб 
            </li>
        </ul>
</div><!-- footer END -->

</div> <!-- all END -->
</body>
</html>
