<form method="post" action=""> 
    <input type="hidden" name="handler" value="{echo $handler}" />
    <div class="inside_padd">
        <button type="submit"  class="btn btn-small btn-primary btn-success"><i class="icon-ok icon-white"></i>{lang('Save', 'template_manager')}</button>
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="span1">
                        {lang('Id', 'template_manager')}
                    </th>
                    <th class="span5">
                        {lang('Name', 'template_manager')}
                    </th>
                    <th class="span5">
                        {lang('Type', 'template_manager')}
                    </th>                               
                </tr>
            </thead>
            <tbody>
                {foreach $properties as $propertie}
                    <tr>
                        <td>
                            {$propertie.id}
                        </td>
                        <td>
                            {$propertie.name}
                        </td>
                        <td>
                            <div>
                                {if $propertie.param}
                                    {$type = unserialize($propertie.param)}
                                {/if}
                                <label>
                                    <input type="checkbox" name="property[prop{echo $propertie.id}][scroll]" {if $type && in_array('scroll',$type)}checked="checked"{/if} value="1" />
                                    scroll
                                </label>
                                <label>
                                    <input type="checkbox" name="property[prop{echo $propertie.id}][dropDown]" {if $type && in_array('dropDown',$type)}checked="checked"{/if} value="1" />
                                    dropDown
                                </label>

                            </div>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        
    </div>
    {form_csrf()}

</form>                            