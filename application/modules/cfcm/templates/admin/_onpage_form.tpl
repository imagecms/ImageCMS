<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
		{echo encode($form->title)}
            </th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd">
                <div class="span9">
    {foreach $form->asArray() as $f}
    

                        <div class="control-group">
                            <label class="control-label">
                    		{$f.label}
                            </label>
                        	<div class="controls">
				    <span class="span6">
                		    {$f.field}
				    
				    {if $f.info.enable_image_browser == 1}            
					<button class="btn btn-small" onclick="elFinderPopup('image', '{$f.name}');return false;"><i class="icon-picture"></i>  {lang('amt_select_image')}</button>
				   {/if}

            {if $f.info.enable_file_browser == 1}
                 <button class="btn btn-small" onclick="elFinderPopup('file', '{$f.name}');return false;"> <i class="icon-folder-open"></i> {lang('amt_select_image')}</button>
            {/if}				   
				    </span>
				    {$f.help_text}
                        	</div>
                        </div>

    {/foreach}
{$hf}
{form_csrf()}

		</div>
	    </div>
	    
	    <div id="elFinder"></div>
	</td>
    </tr>
    </tbody>
</table>