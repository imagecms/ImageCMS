<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Редактировать пункт меню</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="button" class="btn btn-small action_on"><i class="icon-ok"></i>Сохранить</button>
                    <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
                </div>
            </div>                            
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#page_cat" class="btn btn-small active">Страницы и категории</a>
            <a href="#modules" class="btn btn-small">Модули</a>
            <a href="#url" class="btn btn-small">URL</a>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="modules">
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
                            <th class="span2">{lang('a_filter')}</th>
                            <th class="span3">{lang('a_login')}</th>
                            <th class="span3">{lang('a_email')}</th>
                            <th class="span2">{lang('a_group')}</th>
                            <th class="span1">{lang('a_banned')}</th>
                            <th class="span2">{lang('a_b_last_ip')}</th>
                        </tr>
                        <tr class="head_body">
                            <td></td>
                            <td></td>
                            <td>
                                <select>
                                    <option>Login</option>
                                    <option>Email</option>
                                    <option>Group</option>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        
                        {var_dump($users)}
                        {foreach $users as $user}
                        <tr>
                            <td class="t-a_c">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox"/>
                                    </span>
                                </span>
                            </td>
                            <td><p></p></td>
                            <td>
                                <span class="label label-important">on-line</span>
                            </td>
                            <td><p></p></td>
                            <td>
                                <a href="#">{echo $user.username}</a>
                            </td>
                            <td><p>{$user.email}</p></td>
                            <td><p>{echo $user.banned}</p></td>
                            <td><p>&mdash;</p></td>
                        </tr>
                        {/foreach}
                    
                    </tbody>
                </table>

            </div>
            <div class="tab-pane"></div>
        </div>
    </section>
</div>