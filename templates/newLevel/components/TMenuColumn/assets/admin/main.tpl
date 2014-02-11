{$categories = \ShopCore::app()->SCategoryTree->getTree();}
<form method="post" action="">
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
                                            {foreach $params as $value}
                                                <td class="span4">
                                                    <div class="control-group">
                                                        <label class="control-label"><b class="columnName">{lang('Column', 'template_manager')} {echo $value['key']}:</b></label>
                                                        <div class="controls ">
                                                            <select  class="ColumnsSelect" name="column[col{echo $value['key']}][]" multiple="multiple" style="height:400px !important;">
                                                                {foreach $categories as $key => $category}
                                                                    {$selected = ""}
                                                                    {foreach unserialize($value['value']) as $cat}
                                                                        {if $cat == $category['id']}
                                                                            {$selected = "selected='selected'"}
                                                                        {/if}
                                                                    {/foreach}
                                                                    <option {echo $selected} {if count($category['full_path_ids']) == 0}style="font-weight:bold"{/if} value="{echo $key}">{echo str_repeat("-", count($category['full_path_ids']))}{echo $category['name']}</option>

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
        <button type="submit"  class="btn btn-small btn-primary btn-success"><i class="icon-ok icon-white"></i>{lang('Save', 'template_manager')}</button>
    </div>
    {form_csrf()}
</form>