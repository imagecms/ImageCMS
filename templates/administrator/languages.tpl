<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_event_journal')}</span>
            </div>  
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="submit" class="btn btn-small action_on" onclick="MochaUI.languages_create_lang_w();"><i class="icon-ok"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small action_on"><i class="icon-check"></i>Сохранить и выйти</button>
                    <a href="{$ADMIN_URL}languages/create_form">Create</a>
                    <div class="dropdown d-i_b">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                            Русский
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Английский</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_big_td">
            <div class="clearfix">
               
                <div class="pull-right m-t_20">
                    <a href="#">Просмотр страницы <span class="f-s_14">→</span></a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="lang">
                    <div class="row-fluid">
                        <div class="form-horizontal">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>                                              
                                        <th class="span4">{lang('a_name')}</th>
                                        <th class="span4">{lang('a_folder')}</th>
                                        <th class="span4">{lang('a_identif')}</th>
                                        <th class="span4">{lang('a_tpl')}</th>
                                        <th class="span2">{lang('a_image')}</th>
                                    </tr>
                                </thead>
                                <tbody class="sortable ui-sortable">
                                    {foreach $langs as $lang}                                  
                                    <td><p><a href="{$ADMIN_URL}languages/edit/{$lang.id}">{$lang.lang_name}</a></p></td>
                                    <td><p>{$lang.folder}</p></td>
                                    <td><p>{$lang.identif}</p></td>
                                    <td><p>{$lang.template}</p></td>
                                    <td><p><img src="{$lang.image}" width="16" height="16" /></p></td>
                                    </tr>
                                {/foreach}     

                                </tbody>
                            </table>   
                            <div class="control-group">
                                <label class="control-label" for="inputGroupField">{lang('a_by_default')}:</label>
                                <div class="controls">
                                    <select name="folder" id="def_lang_folder" onchange="set_def_lang($('def_lang_folder').value);">
                                        {foreach $langs as $lang}
                                            <option value="{$lang.id}" {if $lang['default'] == "1"} selected="selected" {/if}>{$lang.lang_name}</option>
                                        {/foreach}
                                    </select>

                                </div>

                            </div>                           

                        </div><div class="clearfix">
                            <div class="pagination pull-left">
                                <ul>{$paginator}
                                    <!--                                    <li class="active"><span>1</span></li>
                                                                        <li><a href="#">2</a></li>
                                                                        <li><span>...</span></li>
                                                                        <li><a href="#">4</a></li>-->
                                </ul>
                            </div>
                            <div class="pagination pull-right">
                                <ul>
                                    <li class="disabled"><span>Prev</span></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div> 
                                    
            </div>
        </div>   

    </section>
</div>
