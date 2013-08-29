<div id="gallery_latest_images">
    { _('My last photo'); }
    {foreach $images as $image}
        <a href="{site_url($image.url)}"><img src="{$image.thumb_path}" title="{$image.description}" /></a>
    {/foreach}
</div>
