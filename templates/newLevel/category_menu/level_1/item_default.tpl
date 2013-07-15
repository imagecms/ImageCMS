<li class="column_{echo $CI->load->module('categories_settings')->getColumn($id)}">
    <a href="{$link}" title="{$title}" class="title-category-l1 {if $wrapper != FALSE} is-sub{/if}">
        <span class="helper"></span>
        <span class="text-el">{$title}</span>
    </a>
    {$wrapper}
</li>