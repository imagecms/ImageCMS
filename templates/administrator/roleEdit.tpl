<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_role_edit')}: {echo $model->alt_name}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/roleList" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#role_ed_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_ed_form" data-action="exit"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>

                <div class="dropdown d-i_b">   
                    {$arr = get_lang_admin_folders()}                   
                    {foreach $arr as $a}
                        {if $lang_sel->lang_sel == $a}
                            <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        {if $a == 'english_lang'}{lang('a_english')}{else:}{lang('a_russian')}{/if}
                        <span class="caret"></span>
                    </a>
                {/if}   
            {/foreach}
            <ul class="dropdown-menu">
                {foreach $arr as $a}
                    <li>
                        <a href="{$BASE_URL}admin/rbac/translateRole/{echo $model->id}/{if $a == 'russian_lang'}en{else:}ru{/if}">
                    {if $a == 'english_lang'}{lang('a_russian')} {else:} {lang('a_english')} (beta){/if}
                </a>
            </li>                          
        {/foreach}
    </ul>
</div>
</div>
</div>
</div>
<form method="post" action="{$ADMIN_URL}{echo $model->id}" class="form-horizontal" id="role_ed_form">
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
                                <label class="control-label" for="alt_name">{lang('a_description')}:</label>
                                <div class="controls">
                                    <input type="text" name="alt_name" id="alt_name" value="{echo $model->alt_name}"/>
                                </div>
                            </div>          
                            <div class="control-group">
                                <label class="control-label" for="Description">Полное описание:</label>
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
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="#shop" class="btn btn-small">Магазин</a>
        <a href="#base" class="btn btn-small active">Базовая</a>
        <a href="#module" class="btn btn-small">Модули</a>
    </div> 
    <div class="tab-content">
        {foreach $types as $key => $type} 
            <div class="tab-pane row {if $key == 'base'}active{/if}" id="{echo $key}">
                {foreach $type as $k => $groups} 
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
                                    <th>{echo $groups['description']}</th>
                                </tr>                        
                            </thead>
                            <tbody class="sortable">
                                {foreach $groups['privileges'] as $privilege}
                                    {$checked = null}
                                {if in_array((int)$privilege['id'], $privilegeCheck)}{$checked = 1}{/if}
                                <tr {if $checked == 1}class="active"{/if}>       
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">  
                                                <input type="checkbox" class="chldcheck"  value="{echo $privilege['id']}" name="Privileges[]" {if $checked == 1} checked="checked" {/if}/>
                                            </span>
                                        </span>
                                    </td>
                                    <td style="word-wrap : break-word;">
                                        <p title="{echo $privilege['description']}">{echo $privilege['title']}</p>
                                    </td>
                                    <!--<td><a href="/admin/rbac/deletePermition/{echo $privilege['id']}" class="pjax">удаление</a></td>-->
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            {/foreach}
        </div>
    {/foreach}
</div>
{form_csrf()}
</form>
</section>