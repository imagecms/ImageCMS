<input type="hidden" id="rows_count" name="rows_count" value="{echo $rows_count}">
<input type="hidden" id="page_number" name="rows_count" value="{echo $page}">
{$counter = 0}
{if $po_array}
    {foreach $po_array as $origin => $translation}
        {if $origin}
            <tr class="originTR" {if $counter > 10}style="display: none"{/if}>
                <td class="t-a_c fuzzyTD" rowspan="2">
                    <button type="button" onclick="Translator.markFuzzy($(this))" class="{if $translation['fuzzy']} btn-warning {/if}btn btn-small notCorrect">
                        <i class="icon-lock"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-small translateWord" data-rel="tooltip" data-placement="right" data-original-title="{lang('Translate', 'translator')}" onclick="Translator.translateString($(this))">
                        <i class="icon-globe"></i>
                    </button>
                    <textarea class="origin" readonly="">{echo htmlspecialchars($origin,ENT_QUOTES|ENT_SUBSTITUTE)}</textarea>
                </td>
                <td  rowspan="2">
                    <textarea class="comment" rows="15" >{echo $translation['comment']}</textarea>                
                </td>
                <td class="t-a_c pathsTd" rowspan="2">
                    <select class="links notchosen" size="5">
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
                    <button type="button" data-rel="tooltip" data-placement="right" data-original-title="{lang('Undo', 'translator')}" class="btn btn-small translationCancel">
                        <i class="icon-share-alt"></i>
                    </button>
                    <textarea class="translation">{echo htmlspecialchars($translation['translation'], ENT_QUOTES|ENT_SUBSTITUTE)}</textarea>
                    <textarea class="translationTEMP"></textarea>
                </td>
            </tr>
            {$counter++;}
        {/if}
    {/foreach}
{else:}
    <tr>
        <td colspan="4">
            <div class="alert alert-info">
                {lang('The file is empty.', 'translator')}  
            </div>
        </td>
    </tr>
{/if}

<div class="po_settingsClone">
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

<tr class="pathHolderClone" style="display: none;">
    <td>
        <b class="pathNumber">1</b>
    </td>
    <td>
        <input type="text" name="path[]" class="basePath" style="width: 100%;" value="{echo $po_settings['Basepath']}">
    </td>
    <td >
        <b class="baseTitle">({lang('Basic path', 'translator')})</b>
        <button style="display: none;" class="btn btn-small btn-danger v-a_b" onclick="Translator.deletePath($(this))" type="button">
            <i class="icon-trash"></i>
        </button>
    </td>
</tr>
{foreach $po_settings['SearchPath'] as $key => $path}
    <tr class="pathHolderClone" style="display: none;">
        <td>
            <b class="pathNumber">
                {echo $key+2}
            </b>
        </td>
        <td>
            <input type="text" name="path[]" class="otherPaths" style="width: 100%;" value="{echo $path}">
        </td>
        <td>
            <button class="btn btn-small btn-danger v-a_b" onclick="Translator.deletePath($(this))" type="button">
                <i class="icon-trash"></i>
            </button>
        </td>
    </tr>
{/foreach}
