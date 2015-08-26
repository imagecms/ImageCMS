<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Roles group create","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/groupList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return','admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_cr_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang("Save","admin")}</button>
                <button type="button" class="btn btn-small  formSubmit" data-form="#group_cr_form" data-action="tocreate"><i class="icon-check"></i>{lang('Save and create a new group','admin')}</button>
                <button type="button" class="btn btn-small  formSubmit" data-form="#group_cr_form" data-action="toedit"><i class="icon-check"></i>{lang('Save and edit','admin')}</button>
            </div>
        </div>

    </div>
    <form method="post" action="{$ADMIN_URL}" class="form-horizontal" id="group_cr_form">
        <div class="tab-content">
            <div class="tab-pane active" id="params">
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
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="Name">{lang("Name","admin")}:</label>
                                        <div class="controls">
                                            <input type="text" name="Name" id="Name" value="" />
                                        </div>
                                    </div>
                                        <!--required-->
                                    <div class="control-group">
                                        <label class="control-label" for="Description">{lang("Description","admin")}:</label>
                                        <div class="controls">
                                            <input type="text" name="Description" id="Description" value=""/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="Description">{lang('Group','admin')}:</label>
                                        <div class="controls">
                                            <select name="type">
                                                <option value="shop">Shop</option>
                                                <option value="base">Base</option>
                                                <option value="module">Module</option>
                                            
                                            </select>
                                            <!--<input type="text" name="Description" id="Description" value=""/>-->
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value="On"/>
                                    </span>
                                </span>
                            </th>
                            <th>{//echo $model->getLabel('Privileges')}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $privileges as $privilege}
                            <tr>
                                <td>
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value="{echo $privilege->id}" name="Privileges[]"/>
                                        </span>
                                    </span>
                                </td>
                                <td>
                                    {echo $privilege->name}
                                </td>
                                <td>{echo $privilege->description}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="tab-pane">                     
            </div>
        </div>
        {form_csrf()}
    </form>
</section> 