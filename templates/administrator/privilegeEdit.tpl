<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_edit')} {lang('a_privilege')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/privilegeList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_go_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_ed_form" data-action="close" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_ed_form" data-action="exit"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>               
            </div>
        </div>

    </div>
    <form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="priv_ed_form">
        <div class="tab-content">
            <div class="tab-pane active" id="params">
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
                                <div class="inside_padd span9">
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="Name">{lang('a_name')}:</label>
                                        <div class="controls">
                                            <input type="text" name="Name" id="Name" value="{echo $model->name}" required/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="Description">{lang('a_desc')}:</label>
                                        <div class="controls">
                                            <input type="text" name="Description" id="Description" value="{echo $model->title}"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="GroupId">{lang('a_group')}</label>
                                        <div class="controls">
                                            <select name="GroupId" id="GroupId">
                                                {foreach $groups as $group}
                                                    <option {if $model->group_id == $group->id} selected="selected" {/if} value="{echo $group->id}">{echo ShopCore::encode($group->description)}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {form_csrf()}
    </form>
</section>