{if count($recent_news) > 0}
    <div class="frame-news">
        <div class="inside-padd">
            <div class="title-news">
                <div class="frame-title f-s_0">
                    <div class="title-h1 title">{lang('Новости','greyVision')}</div>
                    <span class="s-t m-r_10 m-l_7">/</span>
                    <a href="{site_url('novosti')}">
                        <span class="text-el">{lang('Архив новостей','greyVision')}</span>
                    </a>
                </div>
            </div>
            <ul class="items items-news">
                {foreach $recent_news as $item}
                    {$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
                    <li>
                        <a href="{site_url($item.full_url)}" class="frame-photo-title">
                            <span class="title">{$item.title}</span>
                        </a>
                        {$item.prev_text}
                        {if trim($item.field_info) != ""}
                            <div class="info">{$item.field_info}</div>
                        {/if}
                        <div class="date">
                            <span class="day">{echo date("d", $item.publish_date)} </span>
                            <span class="month">{echo month(date("n", $item.publish_date))} </span>
                            <span class="year">{echo date("Y ", $item.publish_date)}</span>
                        </div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
{/if}