<span class="helper"></span>
<div class="item_add item_add_style d_i-b">
    <a class="item_href f-s_0 t-d_n" href="{site_url($page.cat_url . $page.url)}"><span class="icon-infoM"></span><span class="d_l_g">{$page.title}</span></a>
    <div class="drop drop_down">
        <div class="drop-content">
            <div class="header_title">{$page.title}</div>
            {echo str_replace("'",'"',$page.prev_text)}
        </div>
    </div>
</div>
