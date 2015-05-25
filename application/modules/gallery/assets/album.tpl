{widget('path')}

<div class="frame-inside without-crumbs">
    <div class="container">
        <h1>{$album.name}</h1>

        <div class="frame-gallery">
            <ul class="items items-photo-galery">
                {foreach $album.images as $image}
                    <li>
                        <a href="{media_url($album_url . $image.full_name)}" class="photo-block" rel="group">
                            <img src="{media_url($thumb_url . $image.full_name)}"
                                 alt="{strip_tags($image.description)}"/>
                        </a>
                        {if trim($image.description) != ''}
                            <div class="description">{$image.description}</div>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>