<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Свойства</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/init_window/new_level/settings">
                        <i class="icon-wrench"></i>
                        Настройки                
                    </a>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="users">
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
        </div>
    </section>
</div>