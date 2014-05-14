{$i=0}
<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <div class="container">
        <ul class="items items-crumbs">
            <li class="btn-crumb">
                <a href="{site_url()}" typeof="v:Breadcrumb">
                    <span class="text-el">{lang('Главная', 'greyVision')}</span>
                </a>
                <span class="divider">→</span>
            </li>
            {foreach $navi_cats as $item} {$i++}
                <li class="btn-crumb" typeof="v:Breadcrumb">
                    {if $i < count($navi_cats)}
                        <a href="{site_url($item.path_url)}" rel="v:url" property="v:title">
                            <span class="text-el">{$item.name}</span>
                        </a>
                        <span class="divider">→</span>
                    {else:}
                        <button rel="v:url" property="v:title" disabled="disabled">
                            <span class="text-el">{$item.name}</span>
                        </button>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>
</div>