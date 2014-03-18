<div class="lang-switch">
{foreach $languages as $lang}
    <a href="/{echo $lang.identif . $current_address}"><img src="{echo $lang['image']}" class="flag" alt="{$lang.lang_name}" />{$lang.lang_name}</a>
{/foreach}
</div>