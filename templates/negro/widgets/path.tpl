{$i=0}
<div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
<span typeof="v:Breadcrumb">
   <a href="{site_url()}">{lang('s_home')}</a>/
   {foreach $navi_cats as $item} {$i++}
   {if $i < count($navi_cats) }
        <a href="{site_url($item.path_url)}">{$item.name}</a> /
   {else: // Make last element as plain text }
       {$item.name}
   {/if}
   {/foreach}
</div>
