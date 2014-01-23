<div class="lang-switch">
{foreach $languages as $lang}
    <a href="/{echo $lang.identif . $current_address}"><img src="{media_url('application/modules/language_switch/templates/i/' . $lang.identif)}.gif" class="flag" alt="{$lang.lang_name}" />{$lang.lang_name}</a>
{/foreach}
</div>