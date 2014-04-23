<div class="clearfix">
    <button type="button" style=" float: right; margin-top: -15px;" class="btn btn-small action_on formSubmit btn-primary" data-form="#component_{echo $handler}_form" data-action="close">
        <i class="icon-ok icon-white"></i>{lang('Save', 'newLevel_TM')}
    </button>
</div>
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th class="span1">
                    {lang('Id', 'newLevel_TM')}
                </th>
                <th class="span5">
                    {lang('Name', 'newLevel_TM')}
                </th>
                <th class="span5">
                    {lang('Type', 'newLevel_TM')}
                </th>                               
            </tr>
        </thead>
        <tbody>
            {foreach $productProperties as $property}
                <tr>
                    <td>
                        {$property.id}
                    </td>
                    <td>
                        {$property.name}
                    </td>
                    <td>
                        <div>
                            {$type = array()}
                            {if $property.param}
                                {$type = unserialize($property.param)}
                            {/if}
                            {foreach $propType as $pt}
                                <label style="display: inline-block;">
                                    <input type="checkbox" name="properties[{echo $property.id}][]" {if $properties[$property.id] && in_array($pt, $properties[$property.id])}checked="checked"{/if} value="{echo $pt}" />
                                    {echo $pt}
                                </label>
                            {/foreach}
                        </div>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {form_csrf()}
</form>                            