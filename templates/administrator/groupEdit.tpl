<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_role_group_edit')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/groupList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_ed_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="tocreate"><i class="icon-check"></i>Сохранить и создать новую группу</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="toedit"><i class="icon-check"></i>Сохранить и редактировать</button>

                <div class="dropdown d-i_b">   
                    {$arr = get_lang_admin_folders()}                   
                    {foreach $arr as $a}
                        {if $lang_sel == $a}
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        {if $a == 'english_lang'}{lang('a_english')}{else:}{lang('a_russian')}{/if}
                        <span class="caret"></span>
                    </a>
                {/if}   
            {/foreach}
            <ul class="dropdown-menu">
                {foreach $arr as $a}
                    <li>
                        <a href="{$BASE_URL}admin/rbac/translateGroup/{echo $model->id}/{if $a == 'russian_lang'}en{else:}ru{/if}">

                    {if $a == 'english_lang'}{lang('a_russian')} {else:} {lang('a_english')} (beta){/if}
                </a>
            </li>                          
        {/foreach}
    </ul>

</div>
</div>
</div>

</div>  
<form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="group_ed_form">
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
                                        <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
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
                <tbody class="sortable">
                    {foreach $privileges as $privilege}
                        <tr>
                            <td>
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value="{echo $privilege->id}" name="Privileges[]" {if $privilege->group_id == $model->id} checked="checked" disabled="disabled"{/if}/>
                                    </span>
                                </span>
                            </td>
                            <td>
                                {echo $privilege->title}
                            </td>
                            <td>{echo $privilege->description}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>                            
        </div>
    </div>
    {form_csrf()}
</form>
</section>