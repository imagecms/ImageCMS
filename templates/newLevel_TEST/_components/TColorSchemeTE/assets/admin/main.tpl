<button type="button" class="btn btn-small action_on formSubmit btn-success" data-form="#component_{echo $handler}_form" data-action="close">
    <i class="icon-check"></i>{lang('Save', 'template_manager')}
</button>
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 
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
                                            <select onchange="changethema(this)" style="width:25% !important" name="color_scheme" id="template">
                                                {foreach $shemes as $sheme => $shemePath}
                                                    <option value="{echo $sheme}" data-shemepath="{echo $shemePath}" {if $mainScheme['color_scheme'] == $sheme}{$mainShemePath = $shemePath;} selected="selected" {/if} >{echo $sheme}</option>
                                                {/foreach}
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls"> 
                                            <img id="logo" style="max-width: 200px" src="{echo $mainShemePath . '/screenshot.png'}" />
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {form_csrf()}
</form>
{literal}
    <script type="text/javascript">
        function changethema(el){
            var shemePath = $(el).find('option:selected').data('shemepath');
            $('#logo').attr('src', shemePath +'/screenshot.png')    
        }
    </script>
{/literal}