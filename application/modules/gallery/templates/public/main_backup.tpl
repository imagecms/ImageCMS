<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Image CMS Gallery</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="generator" content="ImageCMS">

    {literal}
    <style type="text/css">
    body {
        font-size: 12px;
        font-family: Verdana, Sans-serif;  
        background-color: #DDDDDD;
        color: #333333;
        padding: 0;
        margin: 0;  
        width:100%;
        height:100%;
    }

    img {  
        border-style: none;
    } 

    .header {
        font-size:16px;
        background-color:#333333;
        color:#EFEFEF;  
        padding: 5px;
        border-bottom: 4px solid #888383;
    }

    a, a:visited 
    {
        border-bottom:0px;
        color:#225588;
        outline-style:none;
        outline-width:medium;
        text-decoration:underline;
    }

    h1 {
        font-size: 16px;
        text-transform: uppercase;
    }

    .container {
        margin:auto;
        width:750px;
    }

    .content {
        background-color: #F1F1F1; 
        width: 750px;
        padding:5px;
        border:2px solid #CCCCCC; 
        min-height:300px;
        float:left;
    }

    .albums_list {
        position:relative;
    }

    .albums_list ul { 
        list-style:none;
        text-align:left;
    }

    .albums_list li {
        margin:0;
        float:left;
        display:table-cell;
        width:200px;
        height:150px;
        padding:5px;
    }

    .albums_list p {
        padding:0;
        margin:0;
    }

    .date {
        font-size:10px;
        display:block;
    }

    .menu {
        float:left;
        background-color:#F1F1F1;
        padding:5px;
        width:200px;
        background-color: #F1F1F1; 
        border:2px solid #CCCCCC; 

    }

    .menu ul {
        list-style:none;
        padding-left:15px;
    }

    .menu li.empty {
        height:15px;
    }

    </style>
    {/literal}

</head>

<body>

    <div class="header">
        Image CMS Gallery
    </div>

        <div class="container">
            <div class="content">
                {$content}
            </div>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{site_url('gallery')}">Все альбомы</a><li>
                <li class="empty"></li>
                <li>Категрии:<li>
                {foreach $gallery_category as $category}
                <li><a href="{site_url('gallery/category/' . $category.id)}">{$category.name}</a></li>
                {/foreach}
            </ul>
        </div>

</body>
</html>
