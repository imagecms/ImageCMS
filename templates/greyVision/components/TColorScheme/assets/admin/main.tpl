<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 
    <input type="hidden" name="handler" value="{echo $handler}" />
    <div class="form-vertical">
        <div class="row-fluid">
            <div class="control-group">
                <label class="control-label" for="template">{lang('Color scheme', 'greyVision')}:</label>
                <div class="controls">                                         
                    <select onchange="changethema(this)" style="width:25% !important" name="color_scheme" id="template">
                        {foreach $shemes as $sheme => $shemePath}
                            <option value="{echo $sheme}" data-shemepath="{echo $shemePath}" {if $mainScheme['color_scheme'] == $sheme}{$mainShemePath = $shemePath;} selected="selected" {/if} >{echo $sheme}</option>
                        {/foreach}
                    </select> 
                </div>
            </div>
            <div class="row-fluid">
                <div class="span7"> 
                    <img id="logo" src="{echo $mainShemePath . '/screenshot.png'}" class="img-polaroid"/>
                </div>
            </div>
            <button type="button" class="btn btn-small action_on formSubmit btn-primary m-t_20" data-form="#component_{echo $handler}_form" data-action="close">
                <i class="icon-ok icon-white"></i>{lang('Save', 'greyVision')}
            </button>
        </div>
    </div>
    {form_csrf()}
</form>
{literal}
    <script type="text/javascript">
        function changethema(el) {
            var shemePath = $(el).find('option:selected').data('shemepath');
            $('#logo').attr('src', shemePath + '/screenshot.png')
        }
    </script>
{/literal}