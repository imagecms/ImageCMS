<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{$site_title}</title>
    <meta name="description" content="{$site_description}" />
    <meta name="keywords" content="{$site_keywords}" />
    <meta name="generator" content="ImageCMS">

    <link title="" type="application/rss+xml" rel="alternate" href="/rss"/>

    <link rel="stylesheet" href="{$THEME}/css/base.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="{$THEME}/css/style.css" type="text/css" media="screen" />

    { echo imagebox_headers (); } 
</head>

<body>

<div id="container">
    <div id="header">
      <h1><a href="/"><img src="/templates/administrator/images/logo1.png" /></a></h1>
      <div id="user-navigation">
        <ul>
        {if $is_logged_in == TRUE}
          <li> <span style="color:#fff;padding-right:10px;">{lang('lang_welcome')} {$username}</span> <a href="{$modules.auth}/logout">{lang('lang_logout')}</a></li>
        {else:}
          <li><a href="{$modules.auth}/login">{lang('lang_login_page')}</a></li>
          <li><a href="{$modules.auth}/register">{lang('lang_register')}</a></li>
        {/if}
        </ul>
        <div class="clear"></div>
      </div>      
      <div id="main-navigation">
            {load_menu('main_menu')} 
      <div class="clear"></div>
      </div>
    </div>    
    <div id="wrapper">
      <div id="main">
     
        <div class="block" id="block-lists">
          <div class="secondary-navigation">
          &nbsp;
          <div class="clear"></div>
          </div>          
          
          <div class="content">
            {$content}
          </div>

        </div>                          
        <div id="footer">
          <div class="block">
            <p>
           	Время выполнения: <b>{ echo $this->CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end')}</b> /
            Запросовк базе: <b>{ echo $this->CI->db->total_queries()}</b>  /
        	<b>{ echo round(memory_get_usage()/1024/1024, 3)}</b> Мб
            </p>
          </div>      
        </div>
      </div>
      <div id="sidebar">
        <div class="block">
          <h3>Html widget test</h3>
          <div class="content">
            <p>
                {widget('html_test')} 
            </p>
          </div>
        </div>

        <div class="block">
          <h3>Облако Тегов</h3>
            <div class="tags">
                {widget('tags', 10)}
            </div>
        </div>
        <div class="block notice">
          <h4>Последние комментарии:</h4>
          <p>{widget('recent_comments')}</p>
        </div>
        <div class="block">
          <div class="sidebar-block">
            <h4>Recent News Widget</h4>
            <p>{widget('recent_news')}</p>
          </div>
        </div>
      </div>
      <div class="clear"></div>      
    </div>     

      </div>
    </div>
  </div>
</body>
</html>
