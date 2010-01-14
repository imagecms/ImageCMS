{literal}
<style type="text/css">
div.prev_div {
    float:left;
    width:530px;
    text-align:center;
}

#gallery_nav {
    font-size:22px;padding:5px;text-decoration:none;
}

div.gallery_thumbs {
    float:right;
    width:142px;
}

.gallery_thumbs ul { 
    list-style:none;
    text-align:left;
}

.gallery_thumbs li {
    margin:0;
    float:left;
    display:table-cell;
    padding:5px;
}

.gallery_thumbs p {
    padding:0;
    margin:0;
}

.gallery_thumbs img {
    border:2px solid #E8E8E8;
}

</style>
{/literal}

{imagebox_headers()}
<h1>{$album.name}</h1>

<br />

<!-- Preview image -->
<div class="prev_div" id="image">
    <a href="{site_url($album_url . $prev_img.full_name)}" rel="lightbox[gallery]" title="{$prev_img.description}" >
        <img src="{site_url($prev_img.url)}" style="border:5px solid #E8E8E8;" />
    </a>

    <br />
    {$prev_img.full_name} / {$prev_img.width}x{$prev_img.height} / {$prev_img.file_size} / {date('Y-m-d H:i', $prev_img.uploaded)}
</div>

<!-- Thumbs list -->
<div class="gallery_thumbs" align="center">
    {if $prev}<a id="gallery_nav" href="{site_url($album_link . 'image/'. $prev.id)}"#image>←</a>{/if}
    {if $next}<a id="gallery_nav" href="{site_url($album_link . 'image/'. $next.id)}"#image>→</a>{/if}
    <ul>
        {foreach $album.images as $image}
           <li>
           <a href="{site_url($album_link . 'image/'. $image.id)}#image" title="{$image.description}"><img src="{site_url($thumb_url . $image.full_name)}" alt="{$image.description}" /></a>
            <a style="display:none;" rel="lightbox[gallery]" href="{site_url($album_url . $image.full_name)}"></a>
           </li>
        {/foreach}
    </ul>
</div>
