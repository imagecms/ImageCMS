<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>ImageCMS - <?php lang('Installing', 'install') ?></title>
            <link rel="stylesheet" type="text/css" href="/templates/administrator/css/bootstrap.css">

                <style>
                    body {
                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                        background-image: url("/templates/administrator/img/fon_document.png");
                        font-family:"Trebuchet MS", Arial,Tahoma,Verdana; 
                        width:100%; 
                        font-size:13px;
                        min-width:800px;
                        padding:0px;
                        margin:0px;
                    }

                    div.form_text {
                        color:#384654;
                        float:left;
                        font-size:13px;
                        margin-bottom:0.5em;
                        padding-right:1em;
                        padding-top:11px;
                        text-align:right;
                        width:150px;
                    }
                    div.form_input {
                        color:#384654;
                        float:left;
                        margin-bottom:0.5em;
                        padding-top:8px;
                    }
                    div.form_overflow {
                        clear:left;
                        overflow:hidden;
                        padding-top:1px;
                        width:auto;
                    }

                    a.btn{
                        text-decoration: none;
                    }
                    .button_130, .button_silver_130 {
                        -moz-background-clip:border;
                        -moz-background-inline-policy:continuous;
                        -moz-background-origin:padding;
                        background:transparent url('<?php echo $img; ?>btn1_130.png') no-repeat scroll center top;
                        border:0 none;
                        font-size:12px;
                        height:22px;
                        padding:3px;
                        width:130px;
                    }
                    .button_130:hover, .button_silver_130:hover {
                        background-position:center -22px;
                    }

                    .list {
                        list-style:none;
                    }

                    .list li {
                        width:250px;
                        padding:3px;
                    }

                    .list li i{
                        float: right;
                    }

                    .list li:hover {
                        cursor:pointer;
                        background-color:#ADD3DC; 
                    }

                    .list .err {
                        color:#F15323;
                        background-image:url('<?php echo $img; ?>error.png');
                        background-repeat:no-repeat;
                        background-position:center right;
                        border-left:2px solid #DD6464; 
                    }

                    .list .ok {
                        background-repeat:no-repeat;
                        background-position:center right;
                        border-left:2px solid #A8CC4A ; 
                    }
                    .list .warning {
                        background-repeat:no-repeat;
                        background-position:center right;
                        border-left:2px solid #DD6464; 
                    }
                    .textbox {
                        -moz-background-clip:border;
                        -moz-background-inline-policy:continuous;
                        -moz-background-origin:padding;
                        border:1px solid #AAAAAA;
                        color:#555555;
                        padding:4px;
                        vertical-align:middle;
                        width:270px;
                    }
                    .checkbox {
                        padding:4px;
                        vertical-align:middle;
                    }
                    .lite {
                        color:#C2C0C0;
                        font-size:12px;
                    }
                    .errors_list {
                        padding-left:25px;
                        padding-top:10px;
                        color:#F15858; 
                    }

                    section.mini-layout{
                        font-size: 12px;
                        margin-bottom: 20px;
                        padding: 39px;
                        border: 1px solid #DDD;
                        -webkit-border-radius: 6px;
                        -moz-border-radius: 6px;
                        border-radius: 6px;
                        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
                        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.075);
                        box-shadow: 0 1px 2px rgba(0, 0, 0, .075);
                        background-color: white;
                    }
                </style>

                </head>
                <body>
                    <div style="width:960px;margin:auto;margin-top:50px;">
                        <div id="logo">
                            <img src="/templates/administrator/img/logo.png" align="bottom"/>
                        </div>

                        <div id="mainContent" class="container" style="margin-top:25px;">
                            <section class="mini-layout">
                                <form action="/install/change_language" method="POST">
                                    <select name="language" onchange="this.form.submit()" style="float: right; width: 100px;">
                                        <option value="ru_RU" <?php if ($_SESSION['language'] == 'ru_RU') echo 'selected'; ?>><?php echo lang('Russian', 'install')?></option>
                                        <option value="en_US" <?php if ($_SESSION['language'] == 'en_US' || !$_SESSION['language']) echo 'selected'; ?>><?php echo lang('English', 'install')?></option>
                                    </select>
                                    <div style="text-align: right; font-size: 17px; float: right; margin-right: 10px; margin-top: 5px"><b><?php echo lang('Language', 'install') ?>:</b></div>
                                    <?php echo form_csrf() ?>
                                </form>
                                <?php echo $content ?>
                            </section>
                        </div>
                    </div>

                </body>
                </html>
