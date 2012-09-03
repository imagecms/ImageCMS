{$i=0} 
<div>
   <b>{lang('s_navigation')}:</b> {foreach $navi_cats as $item} {$i++}
   {if $i < count($navi_cats) }
        <a href="{site_url($item.path_url)}">{$item.name}</a> / 
   {else: // Make last element as plain text }
       {$item.name}
   {/if}
   {/foreach}
</div>
