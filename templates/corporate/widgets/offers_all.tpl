<div class="frame-side-menu aside-jaw">
    <div class="title-h3">{lang('Продукты','corporate')}</div>
    <nav>
        <ul>
            {foreach $recent_news as $item}
                <li {if $item.id == $page.id} class="active"{/if}>
                    {if $item.id == $page.id}
                        <span>{$item.title}</span>
                    {else:}
                        <a href="{site_url($item.full_url)}">{$item.title}</a>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </nav>
</div>