<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Privileges list","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a class="btn btn-small btn-success pjax" href="/admin/rbac/privilegeCreate" ><i class="icon-plus-sign icon-white"></i>{lang("Create privilege","admin")}</a>
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="$('.modal').modal();"><i class="icon-trash"></i>{lang("Delete","admin")}</button>
            </div>
        </div>  
    </div>
    <div class="tab-content clearfix">
        <form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="role_ed_form">
            <div class="tab-pane active">
                {foreach $groups as $key =>$group} 
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
                                    <th>{echo $group->description}</th>
                                </tr>                        
                            </thead>
                            <tbody>
                                {foreach $group->privileges as $privilege}                             
                                    <tr>       
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">       
                                                    <input type="checkbox" class="chldcheck"  value="{echo $privilege->id}" name="ids" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><a href="/admin/rbac/privilegeEdit/{echo $privilege->id}">{echo $privilege->title}</a></td>                               
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
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Role remove","admin")}</h3>
    </div>
    <div class="modal-body">
        <p>{lang("Remove selected roles?","admin")}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$ADMIN_URL}privilegeDelete')" >{lang("Delete","admin")}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>


<div id="delete_dialog" style="display: none">
    {lang("Remove roles?","admin")}
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->