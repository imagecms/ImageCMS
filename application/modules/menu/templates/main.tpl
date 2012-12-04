<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
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
                        <a href="/admin/components/cp/menu" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                        <a type="button" class="btn btn-small btn-success createLink pjax" href="/admin/components/cp/menu/create_item/{$insert_id}"><i class="icon-plus-sign icon-white"></i>{lang('a_create_link')}</a>
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
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
                            <div>{lang('amt_id')}</div>
                            <div>{lang('amt_tname')}</div>
                            <div>{lang('amt_link')}</div>
                            <div>{lang('amt_type')}</div>
                        </div>
                        <div class=" body_category frame_level">
                            <div class="sortable save_positions" data-url="/admin/components/cp/menu/save_positions">

                                {$tree}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>