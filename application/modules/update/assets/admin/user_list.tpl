
<div class="container">


    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Ключи обновления</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="/admin/components/init_window/update" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                    <a href="/admin/components/init_window/update/user_create" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>Добавить ключ</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="banner_del" onclick="DeleteKey()"><i class="icon-trash icon-white"></i>Удалить ключ</button>
                </div>
            </div>
        </div>
        <form method="get" id="form_list" action="" >
            <div class="tab-content">
                <div class="row-fluid">

                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr class="top_tr">
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" />
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('a_ID')}</th>
                                <th class="span2"><a href="domen">Домен</a></th>
                                <th class="span2"><a href="version">Version</a></th>
                                <th class="span9">Ключ</th>
                                <input type="hidden" name="order" value="{echo $_GET['order']}">

                            </tr>
                            <tr class="head_body">
                                <td></td>
                                <td></td>
                                <td>
                                    <div>
                                        <input name="domen" type="text" value="{echo $_GET['domen']}" >
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input name="version" type="text" value="{echo $_GET['version']}" >
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </thead>
                        {if count($user) > 0}
                            <tbody class="">
                                {foreach $user as $u}
                                    <tr>
                                        <td class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="ids" value="{echo $u['id']}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td><p>{echo $u['id']}</p></td>
                                        <td>
                                            {/*}<a class="pjax" href="/admin/components/init_window/update/user_edit/{echo $u['id']}" >{echo $u['domen']}</a>{ */}
                                            {echo $u['domen']}
                                        </td>

                                        <td>
                                            {echo $u['version']}
                                        </td>
                                        <td>
                                            <input type='text' readonly value="{echo $u['key']}" />
                                        </td>

                                        </div>
                                        </td>
                                    </tr>
                                {/foreach}

                            </tbody>
                        {else:}
                            <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                                Нет ключей
                            </div>
                        {/if}
                    </table>

                </div>
            </div>
        </form>
    </section>
</div>
