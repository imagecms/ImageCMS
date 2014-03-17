<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('Users removing', 'wishlist')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('Remove users?', 'wishlist')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/wishlist/delete_user/')">{lang('Delete', 'wishlist')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel', 'wishlist')}</a>
        </div>
    </div>
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Wish Lists', 'wishlist')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'wishlist')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'wishlist')}
                    </a>
                    <button type="button"
                            class="btn btn-small btn-danger disabled action_on"
                            id="trash_del"
                            onclick="delete_function.deleteFunction()">
                        <i class="icon-trash icon-white"></i>{lang('Delete', 'wishlist')}
                    </button>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">

            <div class="tab-content">
                <div class="tab-pane active" id="users">
                    <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th>{lang('ID', 'wishlist')}</th>
                                <th>{lang('User', 'wishlist')}</th>
                                <th>{lang('Lists count','wishlist')}</th>
                                <th>{lang('Lists items count','wishlist')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $users as $u}
                                <tr>
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" value="{echo $u[id]}"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/components/cp/wishlist/userWL/{echo $u[id]}" class="pjax">{echo $u[id]}</a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/components/cp/wishlist/userWL/{echo $u[id]}" class="pjax" data-rel="tooltip">
                                            {echo ShopCore::encode($u[user_name])}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/components/cp/wishlist/userWL/{echo $u[id]}#lists" class="pjax">{$u[lists_count]} </a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/components/cp/wishlist/userWL/{echo $u[id]}#lists" class="pjax">{$u[items_count]}</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>