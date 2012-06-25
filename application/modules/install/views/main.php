<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ImageCMS - Установка</title>

<?php
    $img = str_replace('index.php', '',$_SERVER['SCRIPT_NAME']).'/application/modules/install/templates/images/';
    $img = reduce_multiples($img,'/');
?>

<style>
body {
    background-image:url('<?php echo $img; ?>bg.png');
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
.button_130, .button_silver_130 {
-moz-background-clip:border;
-moz-background-inline-policy:continuous;
-moz-background-origin:padding;
background:transparent url('<?php echo $img; ?>btn1_130.png') no-repeat scroll center top;
border:0 none;
font-family:'Trebuchet MS',Helvetica,Arial,sans-serif;
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
    background-image:url('<?php echo $img; ?>okay.png');
    background-repeat:no-repeat;
    background-position:center right;
    border-left:2px solid #A8CC4A ; 
}
.list .warning {
    background-image:url('<?php echo $img; ?>warning.png');
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
</style>

</head>
<body>
    <div id="content" style="width:700px;margin:auto;margin-top:50px;">
        <div id="logo">
            <img src="<?php echo $img; ?>logo.png" align="bottom"/>
        </div>

        <div id="main_content" style="margin-top:25px;">
        <?php echo $content ?>
        </div>
    </div>

</body>
</html>
