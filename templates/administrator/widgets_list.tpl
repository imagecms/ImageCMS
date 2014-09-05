
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Widget delete","admin")}</h3>
    </div>
    <div class="modal-body">
        <p>{lang("Delete selected widget(s)?","admin")}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/widgets_manager/delete')" >{lang("Delete","admin")}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel","admin")}</a>
    </div>
</div>
<!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Widgets list","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_wid"><i class="icon-trash icon-white"></i>{lang("Delete","admin")}</button>
                <a href="/admin/widgets_manager/create_tpl" type="button" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang("Create a widget","admin")}</a>
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
                <table class="table  table-bordered table-hover table-condensed t-l_a">
                    <thead>
                        <tr>
                            <th class="t-a_c span1">
                                <span class="frame_label no_connection">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </th>
                            <th>{lang("ID","admin")}</th>
                            <th>{lang("Name","admin")}</th>
                            <th>{lang("Type","admin")}</th>
                            <th>{lang("Description","admin")}</th>
                            <th class="t-a_c">{lang("Settings","admin")}</th>
                        </tr>    
                    </thead>
                    <tbody>
                        {foreach $widgets as $widget}
                            <tr class="simple_tr">
                                <td class="t-a_c span1">
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
                                            data-rel="tooltip" data-title="{lang("Editing","admin")}"
                                        {/if}  
                                        {if $widget.type == 'html'} 
                                            class="pjax" href="/admin/widgets_manager/edit_html_widget/{$widget.id}"
                                        {/if}
                                        >{$widget.name}</a>
                                </td>
                                <td>
                                    {switch $widget.type}
                                    {case 'module':}
                                    {lang("Module","admin")} {$widget.data}
                                    {break}
                                    {case 'html':}
                                    {lang("HTML","admin")}
                                    {break}
                                    {/switch}
                                </td>
                                <td>{$widget.description}</td>
                                <td class="span2 t-a_c">
                                    {if $widget.config == TRUE}
                                        <a class="btn-small btn pjax" href="/admin/widgets_manager/edit/{$widget.id}" data-rel="tooltip" data-title="{lang("Settings","admin")}"><i class="icon-wrench"></i></a>
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
                {lang("No widgets created","admin")}
            </div>
        {/if}
    {/if}        
</section>