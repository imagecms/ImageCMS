{$i=0}
<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <div class="container">
        <ul class="items items-crumbs">
            <li class="btn-crumb">
                <a href="{site_url()}" typeof="v:Breadcrumb">
                    <span class="text-el">{lang('Главная', 'light')}</span>
                </a>
            </li>
            {foreach $navi_cats as $item} {$i++}
                <li class="btn-crumb">
                    {if $i < count($navi_cats)}
                        <a href="{site_url($item.path_url)}" typeof="v:Breadcrumb">
                            <span class="divider">/</span>
                            <span class="text-el">{$item.name}
                        </a>
                    {else:}
                        <button typeof="v:Breadcrumb" disabled="disabled">
                            <span class="divider">/</span>
                            <span class="text-el">{$item.name}</span>
                        </button>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>
</div>
