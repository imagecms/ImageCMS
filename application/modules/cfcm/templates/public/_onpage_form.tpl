{if $form}
    <table class="table  table-bordered table-hover table-condensed content_big_td">
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


                                    {if $f['info']['enable_image_browser'] == "on" || $f['info']['enable_image_browser'] == 1}
                                        <div class="group_icon pull-right">
                                                <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=' . $f.name);}" class="btn iframe-btn" type="button">
                                                    <i class="icon-picture"></i>
                                                    {lang("Select an image", 'cfcm')}
                                                </a>
                                        </div>
                                    {/if}

                                    {if $f['info']['enable_file_browser'] == 'on' || $f['info']['enable_file_browser'] == 1 }
                                        <div class="group_icon pull-right">
                                                <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=2&field_id=' . $f.name);}" class="btn  iframe-btn" type="button">
                                                    <i class="icon-picture"></i>
                                                    {lang("Select a file", 'cfcm')}
                                                </a>
                                        </div>
                                    {/if}
                                    {if'select' === $f.info.type}
                                        {$f.field}
                                    {else:}
                                    <div class="o_h">		            
                                        {$f.field}
                                    </div>
                                    {/if}

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
{else:}
    <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
        {lang("Group without any fields", 'cfcm')}
    </div>
{/if}