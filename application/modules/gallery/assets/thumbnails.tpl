<div class="title">
    <h5>
        <a href="{site_url('gallery')}">{lang('Галерея','gallery')}</a>
        <span class="s-t">{$album.name}</span>
    </h5>
</div>
<ul class="items">
    {foreach $album.images as $image}
        <li>
            <a href="{site_url($album_link . 'image/'. $image.id)}" title="{$image.description}" class="image"><img src="{media_url($thumb_url . $image.full_name)}" alt="{$image.description}" /></a>
        </li>
    {/foreach}
</ul>


