<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-text">
    <div class="container">
        <div class="text-left">
            <div class="btn-additional-s_c2 mq-w-480 mq-min mq-block m-b_20">
                <button type="button">
                    <span class="text-el" data-hide='<span class="d_l">{lang('Скрыть меню','newLevel')}</span> <span class="icon-show-part up"></span>' data-show='<span class="d_l">{lang('Показать меню','newLevel')}</span> <span class="icon-show-part"></span>'></span>
                </button>
            </div>
            <div class="info-menu-page-height">
                {load_menu('left_menu')}
            </div>
        </div>
        <div class="text-right">
            <h1>{echo encode($category.name)}</h1>
            {if $pages == NULL}
                {lang('Категория на стадии разработки', 'newLevel')}
            {else:}
                <ul class="items items-text-category">
                    {foreach $pages as $p}
                        <li>
                            <a href="../{$p.cat_url}{$p.url}" class="frame-photo-title {if $p.field_field_img}is-img{/if}">
                                {if $p.field_field_img}
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img src="{$p.field_field_img}" alt="" />
                                    </span>
                                {/if}
                                <span class="d_b">
                                    <span class="date f-s_0 d_b">
                                        <span class="icon_time"></span><span class="text-el"></span>
                                        <span class="day">{echo date("d", $p.publish_date)} </span>
                                        <span class="month">{echo month(date("n", $item.publish_date))} </span>
                                        <span class="year">{echo date("Y ", $p.publish_date)}</span>
                                    </span>
                                    <span class="title">{$p.title}</span>
                                </span>
                            </a>
                            <div class="description">
                                {$p.prev_text}
                            </div>
                        </li>
                    {/foreach}
                </ul>
                {$pagination}
            {/if}
        </div>
    </div>
</div>
