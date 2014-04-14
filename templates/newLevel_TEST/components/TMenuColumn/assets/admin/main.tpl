{$categories = \ShopCore::app()->SCategoryTree->getTree();}
<button type="button" class="btn btn-small action_on formSubmit btn-success" data-form="#component_{echo $handler}_form" data-action="close">
    <i class="icon-check"></i>{lang('Save', 'template_manager')}
</button>
<form method="post" action="{site_url('admin/components/init_window/template_manager/updateComponent')}/{echo $handler}" id="component_{echo $handler}_form"> 
    <input type="hidden" name="handler" value="{echo $handler}">
    <div class="inside_padd">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Categories columns', 'template_manager')}:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="row-fluid" style="overflow: auto;">
                                <div class="span3">
                                    <table class="table-columns">
                                        <tr>
                                            {foreach $columns as $colon}
                                                <td class="span4">
                                                    <div class="control-group">
                                                        <label class="control-label"><b class="columnName">{lang('Column', 'template_manager')} {echo $colon}:</b></label>
                                                        <div class="controls ">
                                                            <select  class="ColumnsSelect" name="columns[{echo $colon}][]" multiple="multiple" style="height:400px !important;">
                                                                {foreach $categories as $key => $category}
                                                                    {if $columns_db[$colon] && in_array($category['id'], $columns_db[$colon])}
                                                                        {$selected = "selected='selected'";}
                                                                    {/if}
                                                                    <option {echo $selected} {if count($category['full_path_ids']) == 0}style="font-weight:bold"{/if} value="{echo $category['id']}">{echo str_repeat("-", count($category['full_path_ids']))}{echo $category['name']}</option>
                                                                    {$selected = "''";}
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </td>
                                            {/foreach}
                                        </tr>
                                    </table>
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