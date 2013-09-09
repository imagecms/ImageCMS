<ul class="items items-catalog">
    {foreach $recent_news as $item}
        <li>
            {$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
            <div class="date">
                {date('d.m.Y',$item.publish_date)}
            </div>
            <a href="{site_url($item.full_url)}" class="frame-photo-title">
                {if $item.field_image != NULL}
                    <span class="photo-block">
                        <span class="helper"></span>
                        <img src="{media_url($item.field_image)}"/>
                    </span>
                {/if}
                <span class="title">{$item.title}</span>
            </a>
        </li>
    {/foreach}
</ul>