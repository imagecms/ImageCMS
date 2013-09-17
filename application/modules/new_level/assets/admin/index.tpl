<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('New Level', 'new_level')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'new_level')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/init_window/new_level/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'new_level')}                
                    </a>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    
                    <a href="#properties" class="btn btn-small active">{lang('Properties', 'new_level')}</a>
                    <a href="#columns" class="btn btn-small">{lang('Columns', 'new_level')}</a>
                    <a href="/admin/components/init_window/new_level/get_thema" class="btn btn-small">{lang('Colour scheme', 'new_level')}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="properties">
                    <div class="inside_padd">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="span1">
                                        Id
                                    </th>
                                    <th class="span5">
                                        Name
                                    </th>
                                    <th class="span5">
                                        Type
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
                                            <div class="propertyTypesHolder">
                                                {foreach $property_types as $type}
                                                    <label for="{echo $type}_{echo $propertie.id}">
                                                        <input type="checkbox" id="{echo $type}_{echo $propertie.id}" {if in_array($type, unserialize($propertie.type))} checked='checked'{/if} data-properti_Id ="{$propertie.id}" class="propertiesTypes" name="type" value="{echo $type}">          
                                                        {echo $type}
                                                    </label>
                                                {/foreach}
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="columns">
                    <div class="inside_padd">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Categories columns', 'new_level')}:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <table class="table-columns">
                                                        <tr>
                                                            {foreach $columns as $column}
                                                                <td class="span4">
                                                                    <div class="control-group">
                                                                        <label class="control-label" for="iddCategory"><b class="columnName">{lang('Column', 'new_level')} {echo $column}:</b></label>
                                                                        <div class="controls ">
                                                                            <select  id="ajaxSaveShopCategories_{echo $column}" data-id='ajaxSaveShopCategories_{echo $column}' class="ColumnsSelect" name="Categories[]" multiple="multiple" style="height:400px !important;">
                                                                                {foreach $categories as $category}
                                                                                    {if in_array($category->getId(), $columnCategories[$column])}
                                                                                        <option selected {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                                                                    {else:}
                                                                                        <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} {if in_array($category->getId(),$currentCategories)} selected {/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                                                                    {/if}
                                                                                {/foreach}
                                                                            </select>
                                                                            <button type="button" data-column="{echo $column}" class="btn btn-small btn-primary btn-success cattegoryColumnSaveButtonMod"><i class="icon-ok icon-white"></i>{lang('Save', 'new_level')}</button>
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
                </div>
            </div>
        </div>
    </section>
</div>