<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Редактировать ссылку</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="#" class="t-d_n m-r_15 pjax"><span class="f-s_14"><</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#br_tr_form" data-action="tomain"><i class="icon-ok"></i>{lang('a_save')}</button>
            </div>
        </div>                            
    </div>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="#pages" class="btn btn-small active">{lang('a_pages')}</a>
        <a href="#categories" class="btn btn-small">Категории</a>
        <a href="#modules" class="btn btn-small">Модули</a>
        <a href="#url" class="btn btn-small">URL</a>
    </div>        
    <div class="tab-content">
        <div class="tab-pane active" id="pages">
            <div class="row-fluid">
                <form method="post" action="/admin/components/cp/menu/insert_menu_item/" id="br_tr_form">
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_pages')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">Категория:</label>
                                                    <div class="controls">
                                                        <input type="hidden" value="{$menu_id}" name="menu_id"/>
                                                        <input type="hidden" value="0" name="parent_id"/>
                                                        <select id="category_sel">
                                                            <option value="0">Root</option>
                                                            {build_cats_tree($cats, $sel)}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Количество страниц:</label>
                                                    <div class="controls">
                                                        <select id="per_page">
                                                            <option>10</option>
                                                            <option>20</option>
                                                            <option>30</option>
                                                            <option>40</option>
                                                            <option>50</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Список страниц:</label>
                                                    <div class="controls">
                                                        <div id="pages_list_holder">
                                                            <ul>
                                                                {foreach $pages.pages_list as $item}
                                                                    <li><a href="#" class="page_title" data-title="{$item.title}" data-id="{$item.id}">{echo $item.title}</a></li>
                                                                {/foreach}
                                                            </ul>
                                                        </div>
                                                    </div>        
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="span6">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Параметры:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label">Тип:</label>
                                                    <div class="controls">
                                                        <span>Страница</span>
                                                        <input type="hidden" name="item_type" value="page"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">ID:</label>
                                                    <div class="controls">
                                                        <span id="page_id_holder">0</span>
                                                        <input type="hidden" name="item_id"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Заголовок:</label>
                                                    <div class="controls">
                                                        <input type="text" name="title" id="item_title"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Родитель:</label>
                                                    <div class="controls">
                                                        <select name="item_parent_id">
                                                            <option>Нет</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Позиция после:</label>
                                                    <div class="controls">
                                                        <select>
                                                            <option>Нет</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Изображение:</label>
                                                    <div class="controls">
                                                        <input type="text" name="item_image" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Уровень доступа:</label>
                                                    <div class="controls">
                                                        <select multiple="multiple">
                                                            <option>Нет</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Скрыть:</label>
                                                    <div class="controls">
                                                        <span class="frame_label">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" name="hidden" value="1"/>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Открывать в новом окне:</label>
                                                    <div class="controls">
                                                        <span class="frame_label">
                                                            <span class="niceCheck b_n">
                                                                <input type="checkbox" name="newpage" value="1"/>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>						
                    <a class="btn btn-success formSubmit" data-form="#br_tr_form">Сохранить</a>
                    {form_csrf()}
                </form>
            </div>
        </div>
        <div class="tab-pane active" id="categories">
            <div class="row-fluid">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Категории
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label">:</label>
                                            <div class="controls">
                                                <input type="text" name="" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {form_csrf()}
            </div>
        </div>
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Модули
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label">:</label>
                                            <div class="controls">
                                                <input type="text" name="" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {form_csrf()}
            </div>
        </div>
        <div class="tab-pane active" id="url">
            <div class="row-fluid">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                URL
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label">:</label>
                                            <div class="controls">
                                                <input type="text" name="" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
        <div class="tab-pane"></div>
    </div>
</section>