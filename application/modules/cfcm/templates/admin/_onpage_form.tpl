<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
		{lang('a_additional_fields')}
            </th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd">
                <div class="span12">
    {foreach $form->asArray() as $f}
    

                        <div class="control-group">
                            <label class="control-label">
                    		{$f.label}
                            </label>
                        	<div class="controls">
                		    
				    {if $f.info.enable_image_browser == 1}
				    <div class="group_icon pull-right">            
					<button class="btn btn-small" onclick="elFinderPopup('image', '{$f.name}');return false;"><i class="icon-picture"></i>  {lang('amt_select_image')}</button>
					</div>
				   	{/if}

		            {if $f.info.enable_file_browser == 1}
		            	<div class="group_icon pull-right">
		                <button class="btn btn-small" onclick="elFinderPopup('file', '{$f.name}');return false;"> <i class="icon-folder-open"></i> {lang('amt_select_file')}</button>
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
	    </div>
	    
	    <div id="elFinder"></div>
	</td>
    </tr>
    </tbody>
</table>