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
                                <th class="span1">
                                    Name
                                </th>
                                <th class="span1">
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
                                        {foreach $property_types as $type}
                                             <input type="checkbox" data-properti_Id ="{$propertie.id}" class="propertiesTypes" name="type" value="{echo $type}">{echo $type}<br>
                                        {/foreach}
                                       
                                        
                                        { /* }
                                        <select data-properti_Id ="{$propertie.id}" class="propertiesTypes">
                                            {if !$propertie.type}
                                                <option value="">Оберите тип</option> 
                                                {foreach $property_types as $type}
                                                    <option value="{echo $type}">{echo $type}</option> 
                                                {/foreach}
                                            {else:}
                                                 <option value="{echo $propertie.type}">{echo $propertie.type}</option>
                                                 {foreach $property_types as $type}
                                                    {if $type!=$propertie.type}
                                                             <option value="{echo $type}">{echo $type}</option>
                                                    {/if}
                                                 {/foreach}
                                            {/if}
                                            
                                        </select>
                                        { */ }
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