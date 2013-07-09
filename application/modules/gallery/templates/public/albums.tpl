<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang('Gallery')}</span></h5></div>

{if is_array($albums)}
<ul class="products">
    {$counter = 1}
    {foreach $albums as $album}
    <li {if $counter == 3} class="last" {$counter = 0}{/if}>
        <a href="{site_url('gallery/album/' . $album.id)}" class="image"><img src="{$album.cover_url}" border="0" /></a>
        <h3 class="name"><a href="{site_url('gallery/album/' . $album.id)}">{$album.name}</a></h3>
        {//$album.count}
    </li>
    {$counter++}
    {/foreach}
{//$total}
</ul>

{else:}
    {lang('Albums not found')}.
{/if}
