<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_roles_list')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a class="btn btn-small btn-success pjax" href="/admin/rbac/privilegeCreate" ><i class="icon-plus-sign icon-white"></i>{lang('a_create_group')}</a>
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
            </div>
        </div>  
    </div>
    <div class="tab-content clearfix">
        <form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="role_ed_form">
            <div class="tab-pane active">
                {foreach $groups as $key =>$group} 
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
                                    <th>{echo $group->name} {//echo $group->id}</th>
                                </tr>                        
                            </thead>
                            <tbody>
                                {foreach $group->privileges as $privilege}                             
                                    <tr>       
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">       
                                                    <input type="checkbox" class="chldcheck"  value="{echo $privilege->id}" name="Privileges[]" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><a href="/admin/rbac/privilegeEdit/{echo $privilege->id}">{echo $privilege->name}</a></td>                               
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/foreach}
            </div>
            {form_csrf()}
        </form>
    </div>

</section>
<div class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_delete_group')}?</h3>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" onclick="$('.modal').modal('hide');">{lang('a_footer_cancel')}</a>
        <a href="" class="btn btn-primary" onclick="shopCategories.deleteCategoriesConfirm();$('.modal').modal('hide');">{lang('a_delete')}</a>
    </div>
</div>