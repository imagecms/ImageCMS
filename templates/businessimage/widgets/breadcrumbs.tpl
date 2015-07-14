{$loc_last_item = array_pop($navi_cats)}
{if $loc_last_item}
<div class="b-breadcrumbs">
    <div class="g-container">
        <ul class="g-clearfix">
            <li class="b-breadcrumbs__item">
                <a class="b-breadcrumbs__item-link g-link" href="{site_url('')}">{tlang('Home')}</a>
            </li>
            {foreach $navi_cats as $item}
            <li class="b-breadcrumbs__item">
                <a class="b-breadcrumbs__item-link g-link" href="{site_url($item.path_url)}">{$item.name}</a>
            </li>
            {/foreach}
            <li class="b-breadcrumbs__item">
                <span class="b-breadcrumbs__item-text">{$loc_last_item.name}</span>
            </li>
        </ul>
    </div>
</div>
{/if}