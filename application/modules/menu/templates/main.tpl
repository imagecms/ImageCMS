<div class="container">
    
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_menu_delete')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_delete_selected_menu')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/menu/delete_item')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    
    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('a_menu')}: {echo $menu_title}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <a href="/admin/components/cp/menu" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                        <a type="button" class="btn btn-small btn-success createLink pjax" href="admin/components/cp/menu/create_item/{$insert_id}"><i class="icon-list-alt icon-white"></i>{lang('a_create_link')}</a>
                        <button type="button" class="btn btn-small disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang('a_delete')}</button>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('amt_id')}</th>
                                <th class="span3">{lang('amt_tname')}</th>
                                <th class="span3">{lang('amt_link')}</th>
                                <th class="span1">{lang('amt_type')}</th>
                                <th class="span1 t-a_c">{lang('amt_hidden')}</th>
                                <th class="span1"></th>
                            </tr>
                        </thead>
                        <tbody class="sortable save_positions" data-url="/admin/components/cp/menu/save_positions">
                            {foreach $menu_result as $item}
                                <tr>
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" value="{$item.id}"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td><p>{$item.id}</p></td>
                                    <td>
                                        <a href="/admin/components/cp/menu/edit_item/{$item.id}/{$menu_title}" class="pjax">{$item.title}</a>
                                    </td>
                                    <td class="share_alt">
                                        <a href="{echo $item.url}" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>
                                        <a href="#">{$item.url}</a>
                                    </td>
                                    <td><p>{ switch $item['item_type'] }
                                            { case "page": }
                                            {lang('amt_page')}
                                            {break;}
                                            { case "category": }
                                            {lang('amt_category')}
                                            {break;}
                                            { case "module" }
                                            {lang('amt_module')}
                                            {break;}
                                            { case "url": }
                                            {lang('amt_url')}
                                            {break;}
                                            { /switch } </p></td>
                                    <td class="t-a_c">
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{lang('a_turn_on')}"  data-off="{lang('a_turn_off')}">
                                            <span class="prod-on_off item_hidden {if $item['hidden'] != "0"}disable_tovar{/if}" data-id="{$item['id']}"></span>
                                        </div>
                                    </td>
                                    <td class="t-a_c">
                                        {if count($langs) > 1}
                                            <a title="{lang('a_manu_item_translate')}" class="pjax" href="/admin/components/cp/menu/translate_window/{$item.id}"><img src="{$THEME}/images/translit.png" width="16" height="16" /></a> 	
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</div>