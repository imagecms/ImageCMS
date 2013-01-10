
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_widget_deleting')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('a_delete_selected_widgets')}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/widgets_manager/delete')" >{lang('a_delete')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
    </div>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_widgets_list')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_wid"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                <a href="/admin/widgets_manager/create_tpl" type="button" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('a_create_widget')}</a>
            </div>
        </div>  
    </div>
    {if $error}
        <br>
        <div class="alert alert-error">
            {$error}
        </div>
    {else:}   
        {if count($widgets)>0}
            <form method="post" action="#" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1 t-a_c">
                                <span class="frame_label no_connection">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1">{lang('a_id')}</th>
                            <th>{lang('a_n')}</th>
                            <th>{lang('a_type')}</th>
                            <th>{lang('a_desc')}</th>
                            <th class="span2 t-a_c">{lang('a_sett')}</th>
                        </tr>    
                    </thead>
                    <tbody>
                        {foreach $widgets as $widget}
                            <tr class="simple_tr">
                                <td class="span1 t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="{$widget.name}"/>
                                        </span>
                                    </span>
                                </td>
                                <td>{$widget.id}</td>
                                <td> 
                                    <a 
                                        {if $widget.config == TRUE} 
                                            class="pjax" href="/admin/widgets_manager/edit_module_widget/{$widget.id}"
                                        {/if}  
                                        {if $widget.type == 'html'} 
                                            class="pjax" href="/admin/widgets_manager/edit_html_widget/{$widget.id}"
                                        {/if}
                                        data-rel="tooltip" data-title="{lang('a_edit')}">{$widget.name}</a>
                                </td>
                                <td>
                                    {switch $widget.type}
                                    {case 'module':}
                                    {lang('a_module')} {$widget.data}
                                    {break}
                                    {case 'html':}
                                    {lang('a_html')}
                                    {break}
                                    {/switch}
                                </td>
                                <td>{$widget.description}</td>
                                <td class="span2 t-a_c">
                                    {if $widget.config == TRUE}
                                        <a class="btn-small btn pjax" href="/admin/widgets_manager/edit/{$widget.id}" data-rel="tooltip" data-title="{lang('a_sett')}"><i class="icon-wrench"></i></a>
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </form>
        {else:}
            </br>
            <div class="alert alert-info">
                {lang('a_no_widgets_created')}
            </div>
        {/if}
    {/if}        
</section>