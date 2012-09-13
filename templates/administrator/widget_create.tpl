<!--<ul class="breadcrumb">
    <li><a href="#">Главная</a> <span class="divider">/</span></li>
    <li class="active">Список товаров</li>
</ul>-->
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Создание виджета</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
<!--                <a href="{$BASE_URL}admin" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>-->
                <button type="button" class="btn btn-small action_on"><i class="icon-ok"></i>Сохранить</button>
                <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action="#" class="form-horizontal">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    Параметры
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputName">Имя:</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="inputName"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputDesc">Описание</label>
                                                <div class="controls">
                                                    <input type="text" name="description" id="inputDesc">
                                                    <p class="help-block">Краткое описание виджета.</p>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputType">Тип:</label>
                                                <div class="controls">
                                                    <select id="inputType" name="widget_type">
                                                        <option value="module">{lang('a_module')}</option>
                                                        <option value="html">{lang('a_html')}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Название модуля:</label>
                                                <div class="controls" style="top: 6px;">
                                                    <b class="selmod">Последние изображения</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1"></th>
                                <th class="span3">Модуль</th>
                                <th class="span5">Описание</th>
                                <th class="span2">Тип</th>
                            </tr>
                        </thead>
                        <tbody class="sortable ui-sortable">
                            
                            {foreach $blocks as $block}
                                {$type = $block.module_name}
                                {foreach $block.widgets as $item}
                                    <tr data-title="перетащите блок" data-original-title="">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceRadio b_n selwid" data-title="{$item.title}">
                                                    <input type="radio" name="one_column" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><p>{$item.title}</p></td>
                                        <td><p>{$item.description}</p></td>
                                        <td><p>{$type}</p></td>
                                    </tr>
                                {/foreach}
                            {/foreach}
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section>


