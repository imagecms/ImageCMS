<input type="hidden" id="rows_count" name="rows_count" value="{echo $rows_count}">
<input type="hidden" id="page_number" name="rows_count" value="{echo $page}">
{$counter = 0}
{if $po_array}
    {foreach $po_array as $origin => $translation}
        {if $origin}
            <tr class="originTR" {if $counter > 10}style="display: none"{/if}>
                <td class="t-a_c fuzzyTD" rowspan="2">
                    <button type="button" onclick="Translator.markFuzzy($(this))" class="{if $translation['fuzzy']} btn-danger {/if}btn btn-small notCorrect" style="margin-top: 30px"><i class="icon-lock"></i></button>
                </td>
                <td>
                    <button type="button" class="btn btn-small translateWord" data-rel="tooltip" data-placement="right" data-original-title="{lang('Translate', 'translator')}" onclick="Translator.translateString($(this))" style="float: right; margin-right: 5px; margin-bottom: -30px"><i class="icon-globe"></i></button>
                    <textarea class="origin" style="margin-bottom: 0px" readonly="">{echo htmlspecialchars($origin,ENT_QUOTES|ENT_SUBSTITUTE)}</textarea>
                </td>
                <td  rowspan="2">
                    <textarea class="comment" style="margin-bottom: 0px" rows="5" >{echo $translation['comment']}</textarea>                
                </td>
                <td class="t-a_c pathsTd" rowspan="2">
                    <select class="links" size="5">
                        {foreach $translation['links'] as $link}
                            {if $link}
                                <option value="{echo $link}" onclick="Translator.openFileToEdit($(this))" title="{echo $link}">{echo $link}</option>
                            {/if}
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr class="translationTR" {if $counter > 10}style="display: none"{/if}>
                <td>
                    <button type="button" class="btn btn-small translationCancel" style="display: none; float: right; margin-left: 600px; margin-bottom: -30px"><i class="icon-share-alt"></i></button>
                    <textarea class="translation" style="margin-bottom: 0px;">{echo htmlspecialchars($translation['text'], ENT_QUOTES|ENT_SUBSTITUTE)}</textarea>
                    <textarea class="translationTEMP" style="display: none"></textarea>
                </td>
            </tr>
            {$counter++;}
        {/if}
    {/foreach}
{else:}
    <tr>
        <td colspan="4">
            <div class="alert alert-info" style="margin: 0px; text-align: center">
                {lang('The file is empty.', 'translator')}  
            </div>
        </td>
    </tr>
{/if}

<div class="po_settingsClone" style="margin: 0px; display:none">
    <div class="control-group">
        <label class="control-label" for="file">{lang('Project Name', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="projectName" value="{echo $po_settings['Project-Id-Version']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Translator email', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="translatorEmail" value="{echo $po_settings['Last-Translator-Email']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Translator name', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="translatorName" value="{echo $po_settings['Last-Translator-Name']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Language-Team name', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="langaugeTeamName" value="{echo $po_settings['Language-Team-Name']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Language-Team email', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="langaugeTeamEmail" value="{echo $po_settings['Language-Team-Email']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Language', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="language" value="{echo $po_settings['X-Poedit-Language']}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="file">{lang('Country', 'translator')}:</label>
        <div class="controls">
            <input type="text" name="country" value="{echo $po_settings['X-Poedit-Country']}">
        </div>
    </div>
</div>

<div class="pathHolderClone span7" style="margin: 0px; display:none">
    {foreach $paths as $key => $path}
        {if $path['base'] && is_array($path)}
            <div class="path" style="width: 515px">
                <b style="float: left; font-size: 15px; margin-right: 10px; margin-top: 3px;">
                    {echo $key+1}.
                </b>
                <input type="text" name="path[]" class="basePath" style="width: 390px; margin-bottom: 25px;" value="{echo $path['base']}">
                <b style="font-size: 15px; margin-right: -10px; float: right;">({lang('Basic path', 'translator')})</b>
                <br>
            </div>
        {else:}
            <div class="path">
                <b style="float: left; font-size: 15px; margin-right: 10px; margin-top: 3px; ">
                    {echo $key+1}.
                </b>
                <input type="text" name="path[]" style="width: 390px; margin-bottom: -10px;" value="{echo $path}">
                <div class="removePath" onclick="Translator.deletePath($(this))"><i class=" icon icon-remove-sign"></i></div>
                <br>
            </div>
        {/if}
    {/foreach}
</div>


