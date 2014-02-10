
<div class="tabs">
    {foreach $template->components as $key => $component}
        <div id="{echo $key}">
            {$component->renderAdmin()}
        </div>
    {/foreach}
</div>

