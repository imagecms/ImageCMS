<div class="CForms">

    <div class="form_text"></div>
    <div class="form_input"><b>{echo encode($form->title)}</b></div>
    <div class="form_overflow"></div>

    {foreach $form->asArray() as $f}
    	<div class="form_text">{$f.label}</div>
	    <div class="form_input">
            {$f.field}

            {if $f.info.enable_image_browser == 1}            
                 <img src="{$THEME}/images/images.png" width="16" height="16" title="Выбрать Изображение" style="cursor:pointer;padding:2px;" align="absmiddle"  onclick="tinyBrowserPopUp('image', '{$f.name}');" />
            {/if}

            {if $f.info.enable_file_browser == 1}
                 <img src="{$THEME}/images/drive.png" width="16" height="16" title="Выбрать Файл" style="cursor:pointer;padding:2px;" align="absmiddle"  onclick="tinyBrowserPopUp('file', '{$f.name}');" />
            {/if}

            {$f.help_text}
        </div>
    	<div class="form_overflow"></div>
    {/foreach}

{form_csrf()}
</div>
