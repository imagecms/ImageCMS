{$i=0} 
   {foreach $navi_cats as $item} {$i++}    
   {if $i < count($navi_cats) }
        <a href="{site_url($item.path_url)}">{$item.name}</a> &gt;&gt; 
   {/if}
   {/foreach}

