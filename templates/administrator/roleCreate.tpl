<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Role create","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/roleList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back","admin")}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#role_cr_form" data-action="new" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_cr_form" data-action="exit"><i class="icon-check"></i>{lang("Create and exit","admin")}</button>
            </div>
        </div>

    </div>
    <form method="post" action="{$ADMIN_URL}roleCreate" class="form-horizontal m-t_10" id="role_cr_form">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang("Properties","admin")}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="row-fluid">
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="Name">{lang("Title","admin")}:<span class="must" ">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="Name" required="required" class="required" id="Name" value=""/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">{lang("Description","admin")}:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value=""/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">{lang("Importance","admin")}:</label>
                                    <div class="controls">
                                        <input type="text" name="Importance" id="Description" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            {if strpos(getCmsNumber(), 'Premium')}<a href="#shop" class="btn btn-small">{lang('Shop', 'admin')}</a>{/if}
            <a href="#base" class="btn btn-small active">{lang('Basic', 'admin')}</a>
            <a href="#module" class="btn btn-small">{lang('Modules', 'admin')}</a>
        </div> 

        <div class="tab-content">
            {foreach $types as $key => $type}
                {if  strpos(getCmsNumber(), 'Premium') OR $key!='shop'}
                <div class="tab-pane row {if $key == 'base'}active{/if}" id="{echo $key}">
                    {foreach $type as $k => $groups} 
                        <div class="span3">
                            <table class="table  table-bordered table-hover table-condensed t-l_a">
                                <thead>
                                    <tr>
                                        <th class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" />
                                                </span>
                                            </span>
                                        </th>                           
                                        <th>{if $groups['description']}{echo $groups['description']}{else:}{echo $groups['name']} {/if}</th>
                                    </tr>                        
                                </thead>
                                <tbody class="sortable">
                                    {foreach $groups['privileges'] as $privilege}
                                        <tr>       
                                            <td class="t-a_c">
                                                <span class="frame_label">
                                                    <span class="niceCheck b_n">  
                                                        <input type="checkbox" class="chldcheck"  value="{echo $privilege['id']}" name="Privileges[]"/>
                                                    </span>
                                                </span>
                                            </td>
                                            <td style="word-wrap : break-word;">
                                                <p title="{if $privilege['description']}{echo $privilege['description']}{else:}{echo $privilege['name']}{/if}">{if $privilege['title']}{echo $privilege['title']}{else:}{echo $privilege['name']}{/if}</p>
                                            </td>                              
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    {/foreach}
                </div>
                {/if}
            {/foreach}
        </div>
        {form_csrf()}
    </form>
</section>