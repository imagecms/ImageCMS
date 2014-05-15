<div class="frame-crumbs">
    {widget('path')}
</div>

<div class="frame-menu-main vertical-menu">
    {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
</div>
<div class="content">

    <div class="frame-inside page-brand-image">
        <div class="container">
            <div class="f-s_0 title-brand without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i title">{lang('Все бренды магазина','lightVertical')}</h1>
                </div>
            </div>
            <ul class="items items-brand-image">
                {foreach $model as $m}
                <li>
                    <a href="{shop_url('brand/'.$m.url)}" class="frame-photo-title">
                        <span class="photo-block">
                            <span class="helper"></span>
                            <img src="{site_url('uploads/shop/brands/'.$m.image)}"/>
                        </span>
                        <span class="title">{$m.name}</span>
                    </a>
                </li>
                {/foreach}
            </ul>
        </div>
    </div>

</div>