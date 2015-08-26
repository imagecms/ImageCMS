{widget('path')}

<div class="frame-inside without-crumbs">
    <div class="container">
        <h1>{$current_category.name}</h1>
        {if is_array($albums)}
            <ul class="items items-galleries">
                {foreach $albums as $album}
                    <li>
                        <a href="{site_url('gallery/album/' . $album.id)}" class="frame-photo-title">
                            <span class="photo-block"><img src="{$album.cover_url}"/></span>
                            <span class="frame-title d_b"><span class="s-t">{lang('Альбом','gallery')}:</span> <span
                                        class="title">{$album.name}</span></span>
                        </a>
                        {if trim($album.description) != ''}
                            <div class="description">
                                <span class="s-t">{lang('Описание','gallery')}:</span>
                                {$album.description}
                            </div>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        {else:}
            <div class="msg">
                <div class="info">
                    {lang('Альбомов не найдено','gallery')}.
                </div>
            </div>
        {/if}
    </div>
</div>