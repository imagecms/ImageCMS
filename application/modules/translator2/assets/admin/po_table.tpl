<input type="hidden" id="rows_count" name="rows_count" value="{echo $rows_count}">
<input type="hidden" id="page_number" name="rows_count" value="{echo $page}">
{$counter = 0}
{if $po_array}
    {foreach $po_array as $origin => $translation}
        {if $origin}
            <tr class="originTR" {if $counter > 10}style="display: none"{/if}>
                <td class="t-a_c fuzzyTD" rowspan="2">
                    <button type="button" onclick="Translator.markFuzzy($(this))" class="{if $translation['fuzzy']} btn-danger {/if}btn btn-large notCorrect" style="margin-top: 30px"><i class="icon-lock"></i></button>
                </td>
                <td>
                    <button type="button" class="btn btn-small" onclick="Translator.translateString($(this))" style="float: right; margin-left: 600px; margin-bottom: -30px"><i class="icon-globe"></i></button>
                    <textarea class="origin" style="margin-bottom: 0px" readonly="">{echo $origin}</textarea>
                </td>
                <td  rowspan="2">
                    <textarea class="comment" style="margin-bottom: 0px" rows="5" >{echo $translation['comment']}</textarea>                
                </td>
                <td class="t-a_c" rowspan="2">
                    <select class="links"  style="width: 100%;" size="5">
                        {foreach $translation['links'] as $link}
                            {if $link}
                                <option value="{echo $link}">{echo $link}</option>
                            {/if}
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr class="translationTR" {if $counter > 10}style="display: none"{/if}>
                <td>
                    <button type="button" class="btn btn-small translationCancel" style="display: none; float: right; margin-left: 600px; margin-bottom: -30px"><i class="icon-share-alt"></i></button>
                    <textarea class="translation" style="margin-bottom: 0px;">{echo $translation['text']}</textarea>
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
                {lang('The file is empty.')}                        
            </div>
        </td>
    </tr>
{/if}


<div class="pathHolderClone span7" style="margin: 0px; display:none">
    {foreach $paths as $key => $path}
        {if isset($path['base'])}
            <div class="path">
                <b style="float: left; font-size: 15px; margin-right: 10px; margin-top: 3px;">
                    {echo $key+1}.
                </b>
                <input type="text" name="path[]" style="width: 390px; margin-bottom: 25px;" value="{echo $path['base']}">
                <b style="font-size: 15px; margin-right: -10px; float: right;">(Main)</b>
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