<div class="clearfix">
    <input type="text" id="prorerties_filter" style="width: 300px;" placeholder="{lang('Start typing property name here','light')}">
    <button type="button" class="pull-right btn btn-small action_on formSubmit btn-primary" data-form="#component_{echo $handler}_form" data-action="close">
        <i class="icon-ok icon-white"></i>{lang('Save', 'boxGreen')}
    </button>
</div>
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 

    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th class="span1">
                    {lang('Id', 'boxGreen')}
                </th>
                <th class="span5">
                    {lang('Name', 'boxGreen')}
                </th>
                <th class="span5">
                    {lang('Type', 'boxGreen')}
                </th>                               
            </tr>
        </thead>
        <tbody>
            {foreach $productProperties as $property}
                <tr class="property_row">
                    <td>
                        {$property.id}
                    </td>
                    <td class="property_name">
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