<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_users_list')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                    <a href="{$BASE_URL}admin/components/cp/wishlist/settings"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14"></span>
                        <span class="t-d_u">Настройки</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">

            <div class="tab-content">
                <div class="tab-pane active" id="users">
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
                                <th class="span1">{lang('a_ID')}</th>
                                <th class="span5">{lang('a_user')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $users as $u}
                                <tr class="simple_tr">
                                    <td class="t-a_c">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="ids" value="{echo $u[id]}"/>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{$ADMIN_URL}wishlist/userWL/{echo $u[id]}" class="pjax">{echo $u[id]}</a>
                                    </td>
                                    <td>
                                        <a href="{$ADMIN_URL}users/edit/{echo $u[id]}" class="pjax" data-rel="tooltip">
                                            {echo ShopCore::encode($u[user_name])}
                                        </a>
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