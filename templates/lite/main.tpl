<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title}</title>

<meta name="description" content="{$site_description}" />
<meta name="keywords" content="{$site_keywords}" />
<meta name="generator" content="ImageCMS">

{imagebox_headers()}

<link rel="alternate" type="application/rss+xml" title="ImageCMS Lite - Демо Блог о Роботах" href="http://lite.imagecms.net/rss" />
<link rel="icon" href="http://www.imagecms.net/favicon.png" type="image/x-icon" />
<link rel="stylesheet" href="{$THEME}/css/styles.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{$THEME}/css/forms.css" type="text/css" media="screen" />
</head>

<body>

<div class="all">
	<div class="left">
   	 	<div class="top">
			<div class="logo"><a href="/"><img src="{$THEME}/images/logo.png" /></a></div>
            <div style="float:left;">

   			<div id="search">
            	<form action="{site_url('search')}" method="POST">
                {form_csrf()}
                	<input name="text" type="text" value="введите слова для поиска" onclick="this.value='';" />
                    <input type="image" src="{$THEME}/images/search.png" />
                </form>
            </div>

            </div>
    	</div>
		<div class="topmenu">
    	    {load_menu('main_menu')}
        </div>

    <div style="float:left;clear:both;" class="post">
        {$content}
    </div>

    </div>
     <div class="right"> 
        <div class="meta">
        {if !$is_logged_in}
            <a href="{site_url('auth')}">Авторизация</a> 
            <a href="{site_url('auth/register')}">Регистрация</a>
        {else:}
            Здравствуйте, {$username}. <a href="{site_url('auth/logout')}" class="logout">Выход</a>
        {/if}
        </div>

        <div class="category">
            <div class="rightmidbg">
            	<h3>Категории</h3>
                <div class="categorylist">
                	<!-- <ul>
                    	<li><img src="{$THEME}/images/categoryico.jpg" /> <a href="#">Категория 1 (100)</a></li>
                    </ul>
                    -->
                    {category_list('1')}
                </div>
            </div>
        </div>
        <div class="comments">
            <div class="rightmidbg">
            	<h3>Комментарии</h3>
                <div class="commentslist">
                    {widget('latest_comments')}
                </div>
            </div>
        </div>

        <div class="tags" align="center">
            {widget('tags_cloud', 30)}            
        </div>

     </div>
</div>
<div class="bottom">
	<div class="all">
    	<div class="botlogo">
        	
        </div>
        <div class="copy">
        	&copy; 2009 Сайт работает на <a href="http://www.imagecms.net">ImageCMS</a>
        </div>
        <div class="botmenu">
        	<ul>
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
        </div>
    </div>
</div>
</body>
</html>
