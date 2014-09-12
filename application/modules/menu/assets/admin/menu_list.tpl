<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang("Menu deleting", "menu")}</h3>
        </div>
        <div class="modal-body">
            <p>{lang("Delete selected menu?", 'menu')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/menu/delete_menu')" >{lang("Delete", "menu")}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", "menu")}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <form id="deleteMenu">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang("Menu list", "menu")}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '{$BASE_URL}admin/components/cp/menu/create_tpl'"><i class="icon-plus-sign icon-white"></i>{lang("Create a menu", "menu")}</button>
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang("Delete", "menu")}</button>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <table class="table  table-bordered table-hover table-condensed t-l_a">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th>{lang("ID", "menu")}</th>
                                <th>{lang("Denotation", "menu")}</th>
                                <th>{lang("Name", "menu")}</th>
                                <th>{lang("Description", "menu")}</th>
                                <th>{lang("Created", "menu")}</th>
                                <th>{lang("Editing", "menu")}</th>
                            </tr>
                        </thead>
                        <tbody >
                            {if count($menus) > 0}
                                {foreach $menus as $item}
                                    <tr class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n" >
                                                    <input type="checkbox" name="ids" value="{$item.name}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td ><p>{$item.id}</p></td>
                                        <td>
                                            <a class="pjax" href="{$SELF_URL}/menu_item/{$item.name}" id="del" >{$item.main_title}</a>
                                        </td>
                                        <td><p>{$item.name}</p></td>
                                        <td>{$item.description}
                                        </td>
                                        <td>{$item.created}</td>
                                        <td><a href="{$BASE_URL}admin/components/cp/menu/edit_menu/{$item.id}" class="pjax">{lang("Editing", "menu")}</a></td>
                                    </tr>
                                {/foreach}
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</div>