<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang("Menu items deleting", 'menu')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang("Delete selected menu items?", 'menu')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/menu/delete_item')" >{lang("Delete", "menu")}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel", "menu")}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang("Menu", "menu")}: {echo $menu_title}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <a href="/admin/components/cp/menu" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", "menu")}</span></a>
                        <a type="button" class="btn btn-small btn-success createLink pjax" href="/admin/components/cp/menu/create_item/{$insert_id}"><i class="icon-plus-sign icon-white"></i>{lang("Create link", "menu")}</a>
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang("Delete", "menu")}</button>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <div id="category">
                        <div class="row-category head">
                            <div class="t-a_c">
                                <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px; ">
                                        <input type="checkbox">
                                    </span>
                                </span>
                            </div>
                            <div>{lang("ID", "menu")}</div>
                            <div>{lang("Name", "menu")}</div>
                            <div>{lang("Link", "menu")}</div>
                            { /* }<div>{lang('Type', "menu")}</div>{ */ }
                            <div>{lang('Show', 'menu')}</div>
                        </div>
                        <div class=" body_category frame_level">
                            <div class="sortable save_positions menu-table" data-url="/admin/components/cp/menu/save_positions">
                                {$tree}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>