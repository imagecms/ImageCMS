{foreach $tree as $page}
    <option value="{echo $page['id']}">{echo ShopCore::encode($page['name'])}</option>
{/foreach}