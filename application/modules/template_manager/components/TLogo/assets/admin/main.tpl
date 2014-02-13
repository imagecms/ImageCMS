<form method="post" class="form-horizontal">
    <input type="hidden" name="handler" value="{echo $handler}" />
    <div class="inside_padd">
        <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
            <thead>
            <th class="span1">{lang('Settings', 'template_manager')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>

                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="row-fluid">
                                    <div class="control-group">
                                        <label class="control-label" for="template">{lang('Colour scheme', 'template_manager')}:</label>
                                        <div class="controls">                                           
                                            <select onchange="changethema(this)" style="width:25% !important" name="colorSchema[color_scheme]" id="template">
                                                {foreach $allScheme as $k => $tm}
                                                    <option value="{echo $tm}" {if $mainSchema == $tm} selected="selected" {/if} >{echo $k}</option>
                                                {/foreach}
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls"> 
                                            <img id="logo" style="max-width: 200px" src="{echo '/' . $mainSchema . '/screenshot.png'}" />
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Save', 'template_manager')}</button>
    </div>
    {form_csrf()}
</form>
{literal}
    <script type="text/javascript">
        function changethema(el){
            $('#logo').attr('src','/'+$(el).val()+'/screenshot.png')    
        }
    </script>
{/literal}