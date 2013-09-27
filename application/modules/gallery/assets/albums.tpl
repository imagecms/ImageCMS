<div id="titleExt"><h5>{widget('path')}<span class="ext">{lang('Gallery', 'gallery')}</span></h5></div>
{if $gallery_category[0]}
<div>
    <h1>{echo $gallery_category[0]['name']}</h1>
    <p>{echo $gallery_category[0]['description']}</p>
</div>
{/if}
{if is_array($albums)}
    <ul class="products">
        {$counter = 1}
        {foreach $albums as $album}
            <li {if $counter == 3} class="last" {$counter = 0}{/if}>
                <a href="{site_url('gallery/album/' . $album.id)}" class="image"><img src="{$album.cover_url}" border="0" /></a>
                <h3 class="name"><a href="{site_url('gallery/album/' . $album.id)}">{$album.name}</a></h3>
                <p>{$album.description}</p>
                    {//$album.count}
            </li>
            {$counter++}
        {/foreach}
        {//$total}
    </ul>

{else:}
    {lang('Albums not found', 'gallery')}.
{/if}
