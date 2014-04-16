{if count($recent_news) > 0}
<div class="frame-news">
    <div class="container">
        <div class="frame-title">
            <div class="title_h1 d_i">{lang("News","admin")}</div>
            <span class="m-l_10">
                <a href="{site_url('novosti/')}"><span class="text_el">Смотреть все</span></a>
            </span>
        </div>
        <ul class="items items_news row-fluid">
            {foreach $recent_news as $item}
            {$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
            <li class="span4">
                <a href="{site_url($item.full_url)}">
                    {if trim($item.field_img) != ""}
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img src="{$item.field_img}" alt="" />
                    </span>
                    {/if}
                    <span class="date f-s_0">
                        <span class="day">{echo date("d", $item.publish_date)} </span>
                        <span class="month">{echo date("F", $item.publish_date)} </span>
                        <span class="year">{echo date("Y ", $item.publish_date)}</span>
                    </span>
                    <span class="title">{$item.title}</span>
                </a>
                <div class="description">
                    {$item.prev_text}
                    {if trim($item.field_info) != ""}
                    <div class="info">{$item.field_info}</div>
                    {/if}
                </div>
            </li>
            {/foreach}
        </ul>
    </div>
</div>
{/if}
