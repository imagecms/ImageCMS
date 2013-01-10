{include_tpl('shop/default/sidebar')}

<div class="products_list">

    <div id="titleExt">
        <h5 class="left">{echo encode($page.title)}</h5>
        <div class="right"></div>
        <div class="sp"></div>
    </div>

    {$page.full_text}

    <p>
        <a href="javascript:history.back(-1);">{lang('history_back')}</a>
    </p>
</div>
