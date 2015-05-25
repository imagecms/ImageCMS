<table class="table  table-bordered table-hover table-condensed content_big_td m-t_10">
    <thead>
        <tr>
            <th colspan="6">
                {lang("Additional fields", 'cfcm')}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    {foreach $form->asArray() as $f}


                        <div class="control-group">
                            <label class="control-label">
                                {$f.label}
                            </label>
                            <div class="controls">

                                {if $f.info.enable_image_browser == 1}
                                    <div class="group_icon pull-right">            
                                        <button class="btn btn-small" onclick="elFinderPopup('image', '{$f.name}');
                                                return false;"><i class="icon-picture"></i>  {lang("Select an image", 'cfcm')}</button>
                                    </div>
                                {/if}

                                {if $f.info.enable_file_browser == 1}
                                    <div class="group_icon pull-right">
                                        <button class="btn btn-small" onclick="elFinderPopup('file', '{$f.name}');
                                                return false;"> <i class="icon-folder-open"></i> {lang("Select a file", 'cfcm')}</button>
                                    </div>
                                {/if}

                                <div class="o_h">		            
                                    {$f.field}
                                </div>

                                {$f.help_text}
                            </div>
                        </div>

                    {/foreach}
                    {$hf}
                    {form_csrf()}
                </div>

                <div id="elFinder"></div>
            </td>
        </tr>
    </tbody>
</table>