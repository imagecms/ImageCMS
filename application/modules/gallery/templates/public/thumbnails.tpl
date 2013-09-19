<div id="titleExt"><h5><a href="{site_url('gallery')}">{lang('Gallery', 'gallery')}</a> &gt;&gt; <span class="ext">{$album.name}</span></h5></div>
<ul class="products thumbs">
    {$counter = 1}
    {foreach $album.images as $image}
        <li {if $counter == 4} class="last" {$counter = 0}{/if}>
            <a href="{site_url($album_link . 'image/'. $image.id)}" title="{strip_tags($image.description)}" class="image"><img src="{media_url($thumb_url . $image.full_name)}" alt="{strip_tags($image.description)}" />
                </a>
                <p>{echo $image.description}</p>
        </li>
        {$counter++}
    {/foreach}

    {echo $pagination}
</ul>


