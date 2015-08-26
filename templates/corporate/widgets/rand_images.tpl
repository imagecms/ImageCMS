<div id="gallery_latest_images">
    {foreach $images as $image}
        <a href="{$image.url}"><img src="{$image.thumb_path}" title="{$image.description}" /></a>
    {/foreach}
</div>
