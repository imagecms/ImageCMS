{literal}
    <style type="text/css"> 
    #php_info {color: #000000;}
    #php_info, td, th, h1, h2 {font-family: sans-serif;}
    #php_info pre {margin: 0px; font-family: monospace;}
    #php_info a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
    #php_info a:hover {text-decoration: underline;}
    #php_info table {border-collapse: collapse;}
    #php_info .center {text-align: center;}
    #php_info .center table { margin-left: auto; margin-right: auto; text-align: left;}
    #php_info .center th { text-align: center !important; }
    #php_info td, th { border: 1px solid #000000; font-size: 100%; vertical-align: baseline;}
    #php_info h1 {font-size: 150%;}
    #php_info  h2 {font-size: 125%;}
    #php_info .p {text-align: left;}
    #php_info .e {background-color: #ccccff; font-weight: bold; color: #000000;}
    #php_info .h {background-color: #9999cc; font-weight: bold; color: #000000;}
    #php_info .v {background-color: #cccccc; color: #000000;}
    #php_info .vr {background-color: #cccccc; text-align: right; color: #000000;}
    #php_info img {float: right; border: 0px;}
    #php_info hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
    </style>
{/literal}

<div class="top-navigation">
    <ul>
        <li><p>Информация о системе</p></li>
    </ul>
</div>

	<div class="form_text">Загруженность сервера</div>
	<div class="form_input">
    {if function_exists('sys_getloadavg') AND is_array(sys_getloadavg())}
	    {$load_averages = sys_getloadavg()}
    	<!-- {array_walk($load_averages, create_function('&$v', '$v = round($v, 3);'))} -->
	    {$server_load = $load_averages[0].' '.$load_averages[1].' '.$load_averages[2]}
    {/if} 
    </div>
	<div class="form_overflow"></div>

    <div class="form_text">Сервер</div>
	<div class="form_input">
        Операционная система:<span style="padding-left:3px;"><?php echo PHP_OS ?></span><br />
        PHP:<span style="padding-left:3px;"><?php echo PHP_VERSION ?></span> 
        <a href="#" onclick="ajax_div('php_info', base_url + 'admin/sys_info/phpinfo'); return false;"> phpinfo</a>
    </div>
	<div class="form_overflow"></div>

    {if $db_version}
        <div class="form_text">База данных</div>
        <div class="form_input">
            Версия: {$db_version}<br/>
            Строк: {$db_rows}<br/>
            Размер: {$db_size}
        </div>
        <div class="form_overflow"></div>
    {/if}

    <div class="form_text">Права на запись</div>
	<div class="form_input">
        {foreach $folders as $k => $v}
            {if $v == TRUE}
                {$color='green'}
            {else:}
                {$color='#E25B5B'}
            {/if}
            <span style="color:{$color};">{$k}</span><br />
        {/foreach}
    </div>
	<div class="form_overflow"></div>

<div id="php_info"></div>
