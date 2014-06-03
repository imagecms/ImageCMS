<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <div class="container">
        <ul class="items items-crumbs">
            <li class="btn-crumb">
                <a href="{site_url()}" typeof="v:Breadcrumb">
                    <span class="text-el">{lang('Главная', 'gallery')}<span class="divider">→</span></span>
                </a>
            </li>
            <li class="btn-crumb">
                <a href="{site_url('gallery')}" typeof="v:Breadcrumb">
                    <span class="text-el">{lang('Галерея', 'gallery')}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="frame-inside without-crumbs">
    <div class="container">
        <h1>{$album.name}</h1>
        <div class="frame-gallery">
            <ul class="items items-photo-galery">
                {foreach $album.images as $image}
                    <li>
                        <a href="{site_url($album_url . $image.full_name)}" title="{strip_tags($image.description)}" class="photo-block" rel="group">
                            <img src="{site_url($thumb_url . $image.full_name)}" alt="{strip_tags($image.description)}" />
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>