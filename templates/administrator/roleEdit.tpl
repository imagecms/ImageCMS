<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_role_edit')}: {echo $model->name}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/roleList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#role_ed_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_ed_form" data-action="exit"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>
            </div>
        </div>
    </div>


    <div class="tab-content clearfix">
        <form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="role_ed_form">
            <div class="tab-pane active">
                <div class="tab-pane ">    

                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('a_param')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="Name">{lang('a_name')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="Name" id="Name" value="{echo $model->name}" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Description">{lang('a_description')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="Importance">{lang('a_imp_rbak')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="Importance" id="Importance" value="{echo $model->importance}"/>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {foreach $groups as $key =>$group} 
                    {if $group->privileges}
                        <div class="span3">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" />
                                                </span>
                                            </span>
                                        </th>                           
                                        <th>{echo $group->name}</th>
                                    </tr>                        
                                </thead>
                                <tbody class="sortable">
                                    {foreach $group->privileges as $privilege}                             
                                        <tr>       
                                            <td class="t-a_c">
                                                <span class="frame_label">
                                                    <span class="niceCheck b_n">  
                                                        <input type="checkbox" class="chldcheck"  value="{echo $privilege->id}" name="Privileges[]" {if in_array($privilege->id, $privilegeCheck)} checked="checked" {/if}  />
                                                    </span>
                                                </span>
                                            </td>
                                            <td><p>{echo $privilege->name}</p></td>                               
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    {/if}
                {/foreach}
            </div>
            {form_csrf()}
        </form>
    </div>
</section>