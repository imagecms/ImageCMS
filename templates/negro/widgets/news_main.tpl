<div class="f_l frame-news">
    <ul>
        {foreach $recent_news as $item}
            {$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
            <li>
                <a href="{site_url($item.full_url)}">
                    {if trim($item.field_img) != ""}
                        <span class="photo-block">
                            <span class="helper"></span>
                            <img src="{$item.field_img}" alt="" />
                        </span>
                    {/if}
                    <span class="title">{$item.title}</span>
                </a>
                {$item.prev_text}
                {if trim($item.field_info) != ""}
                    <div class="date">{$item.field_info}</div>
                {/if}
            </li>
        {/foreach}
    </ul>
</div>
