<div class="lang-switch">
{foreach $languages as $lang}
    <a href="{if $lang['default']}/{else:}/{echo $lang.identif . $current_address}{/if}"><img src="{echo $lang['image']}" class="flag" alt="{$lang.lang_name}" />{$lang.lang_name}</a>
{/foreach}
</div>