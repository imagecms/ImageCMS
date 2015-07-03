{foreach $tree as $page}
    <option value="{echo $page['id']}">{echo encode($page['name'])}</option>
{/foreach}