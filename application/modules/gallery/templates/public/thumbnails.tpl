{literal}
<style type="text/css">

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

<h1>{$album.name}</h1>

<br />

<ul class="gallery_thumbs">
    {foreach $album.images as $image}
       <li>
       <a href="{site_url($album_link . 'image/'. $image.id)}" title="{$image.description}"><img src="{media_url($thumb_url . $image.full_name)}" alt="{$image.description}" /></a>
        <a style="display:none;" href="{site_url($album_url . $image.full_name)}"></a>
       </li>
    {/foreach}
</ul>

