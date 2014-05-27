<li>
    <a href="{$link}" title="{$title}" class="frame-photo-title">
        <span class="photo-block">
            <span class="helper"></span>
            {if $image}
                <img src="{$image}" alt="{echo $title}"/>
            {else:}
                <img src="{site_url('uploads/shop/nophoto/nophoto.jpg')}" alt="{lang('Нет фото', 'light')}"/>
            {/if}
        </span>
        <span class="text-el">{$title}</span>
    </a>
</li>