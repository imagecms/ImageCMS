<div class="frame-inside">
    <div class="container">
        <h1>{lang('Gallery','gallery')}</h1>
        {if is_array($albums)}
            <ul class="items items-galleries">
                {foreach $albums as $album}     
                    <li>
                        <a href="{site_url('gallery/album/' . $album.id)}" class="frame-photo-title">
                            <span class="photo-block">
                                <img src="{$album.cover_url}"/>
                            </span>
                            <span class="frame-title">
                                <span class="s-t">{lang('Album','gallery')}:</span> 
                                <span class="title">{$album.name}</span>
                            </span>
                        </a>
                        <div class="description">

                        </div>
                    </li>
                {/foreach}
            </ul>
        {else:}
            <div class="msg">
                <div class="info">
                    {lang('Empty','gallery')}.
                </div>
            </div>
        {/if}
    </div>
</div>