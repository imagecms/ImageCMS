{foreach $tree as $page}
    <option {if !$page['level']}style="font-weight: bold;"{/if}
            value="{echo $page['id']}">{str_repeat('-',$page['level'])}{echo encode($page['name'])}</option>
{/foreach}