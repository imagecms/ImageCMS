{$counter = 0}
{foreach $recent_news as $item}
{$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
    <p {if $counter == 0} class="first" {/if}><a href="{site_url($item.full_url)}" class="image"><img src="{media_url($item.field_image)}" border="0" alt="image" /></a><a href="{site_url($item.full_url)}">{$item.title}</a></p>
{$counter++}
{/foreach}
