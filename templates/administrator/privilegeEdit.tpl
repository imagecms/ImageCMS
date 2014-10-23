<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Editing","admin")} {lang("Privileges","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/privilegeList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back","admin")}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#priv_ed_form" data-action="close" data-submit><i class="icon-ok"></i>{lang("Save","admin")}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#priv_ed_form" data-action="exit"><i class="icon-check"></i>{lang("Save and go back","admin")}</button>    

                <div class="dropdown d-i_b">   
                    {$arr = get_lang_admin_folders()}                   
                    {foreach $arr as $a}
                        {if $lang_sel == $a}
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        {if $a == 'english_lang'}{lang("English","admin")}{else:}{lang("Russian","admin")}{/if}
                        <span class="caret"></span>
                    </a>
                {/if}   
            {/foreach}
            <ul class="dropdown-menu pull-right">
                {foreach $arr as $a}
                    <li>
                        <a href="{$BASE_URL}admin/rbac/translatePrivilege/{echo $model->id}/{if $a == 'russian_lang'}en{else:}ru{/if}">

                    {if $a == 'english_lang'}{lang("Russian","admin")} {else:} {lang("English","admin")} (beta){/if}
                </a>
            </li>                          
        {/foreach}
    </ul>

</div>
</div>
</div>

</div>
<form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="priv_ed_form">
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
                                        <input type="text" name="Name" id="Name" value="{echo $model->name}" required/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Title">{lang("Description","admin")}:</label>
                                    <div class="controls">
                                        <input type="text" name="Title" id="Title" value="{echo $model->title}"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Description">{lang('Full description','admin')}:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="GroupId">{lang("Group","admin")}</label>
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