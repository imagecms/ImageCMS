{foreach $recent_news as $item}
{$item = $CI->load->module('cfcm')->connect_fields($item,'page')}
    <div class="grid_4">
    <h4>{$item.title}</h4>
	<div class="img_inner"><img src="{$item.field_image}" alt="" class=""></div><br/>
    <p>{$item.prev_text}</p>
	<a href="{site_url($item.full_url)}" class="btn">подробнее</a>
    </div>
{/foreach}
