<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Панель Управления - Image CMS</title>
	<meta name="description" content="Панель Управления - Image CMS" />


	<link rel="stylesheet" href="{$THEME}/css/content.css" type="text/css"/>

	<!--[if IE]>
		<script type="text/javascript" src="{$JS_URL}/mocha/excanvas-compressed.js"></script>
	<![endif]-->

	<script type="text/javascript" src="{$JS_URL}/mocha/mootools-1.2-core.js"></script>
	<script type="text/javascript" src="{$JS_URL}/mocha/mootools-1.2-more.js"></script>
	<script type="text/javascript" src="{$JS_URL}/plugins/Roar.js"></script>
	<script type="text/javascript" src="{$JS_URL}/mocha/functions.js"></script>

	<script  type="text/javascript">
        var theme = '{$THEME}';
        var base_url = '{$BASE_URL}';
    </script>

	{literal}
	<STYLE TYPE="text/css">
	body {
		margin: 0px 20px 0px 20px;
		background-image:url('/templates/administrator/images/bg2.png');
        background-color:#333344;
        text-align: center;
        height:95%; 
        width:95%;
	}
	#box {
		margin: 0 auto;   		
        text-align: left; 
        padding-top:150px;
		width: 400px;

	}
	h1{
		padding-left:55px;
        font-size:20px;
	}
	.error {
		color:red;
		font-size:12px;
	}
	#s_text {
		color:#B1B1B1;
		font-weight:bold;
	}
    .b_list  {
        margin:0;
        padding:0;
    }
    .b_list {
        list-style:none;
    }
    .b_list a {
        color:silver;
    }
    .b_list a:hover {
        color:#6D9CB2; 
    }
    .b_list li {
        float:left;
        padding-right:10px;
    }
	</STYLE>
	{/literal}

</head>
<body>

<div id="spinner"></div>

<div id="login_form_box">

<?php
$ci = get_instance();

if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
    die('<span style="font-size:18px;"><br/><br/>Для продолжения работы, удалите файл ./application/modules/install/install.php</div>');
?>

<div id="box">

<img src="{$THEME}/images/logo_big.png" />

<br/>

{if $login_failed}
    {$login_failed}
{/if}

<p>
    <form method="post" action="{$BASE_URL}admin/login/" id="login_form">
    {$lang_login}: <br/>  <input type="text" name="login" class="textbox_long" />{$login_error}<br/>
    {$lang_password}: <br/> <input type="password" name="password" class="textbox_long" />{$password_error}<br/>
    <br/><label><input type="checkbox" name="remember" value="1" /> Запомнить меня</label><br/>

        {if $use_captcha == "1"}
            {$lang_captcha}:<br/>
            <div id="captcha">
                {$cap_image}
            </div>
            <a href="#" onclick="ajax_div('captcha','{$BASE_URL}/admin/login/update_captcha');return false;">Обновить код</a>
            <br/><br/>
            <input type="text" class="textbox_long" size="30" name="captcha" />{$captcha_error}<br/>
        {/if}

    <br/>
    <input type="submit" name="button"   class="button" value="{$lang_submit}" />
    {form_csrf()}
    </form>
</p>

<div style="right:0;bottom:0;position:absolute;font-size:11px;padding:3px;">
    <span style="color:silver;font-size:12px; font-weight:bold;">Поддерживаются следующие браузеры:</span>
    <ul class="b_list"> 
        <li><a href="http://www.mozilla.com/" target="_blank">Firefox</a></li> 
        <li><a href="http://www.opera.com/browser/download/" target="_blank">Opera</a></li>
        <li><a href="http://www.apple.com/safari/" target="_blank">Safari</a></li>
        <li><a href="http://www.google.com/chrome/" target="_blank">Google Chrome</a></li>
    </ul>
</div>

</div>

</div>

</body>
</html>
