<form method="post" action="#">
    <!--    <ul class="breadcrumb">
            <li><a href="#">Главная</a> <span class="divider">/</span></li>
            <li class="active">Главное меню</li>
        </ul>-->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_all_modules')}</span>
            </div>
            <!--            <div class="pull-right">
                            <div class="d-i_b">
                                <button type="button" class="btn btn-small btn-success"><i class="icon-list-alt icon-white"></i>Создать пункт меню</button>
                                <button type="button" class="btn btn-small disabled action_on"><i class="icon-trash"></i>Удалить</button>
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
                        </div>                            -->
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#modules" class="btn btn-small">{lang('a_modules')}</a>
            <a href="#set_modul" class="btn btn-small active">{lang('a_install_modules')}</a>
        </div>
        <div class="tab-content">
            {if count($installed) != 0}
                <div class="tab-pane active" id="modules">
                    <div class="row-fluid">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="span3">{lang('a_module')}</th>
                                    <th class="span3">{lang('a_desc')}</th>
                                    <th class="span2">{lang('a_url')}</th>
                                    <th class="span1">{lang('a_autoload')}</th>
                                    <th class="span1">{lang('a_url_access')}</th>
                                </tr>
                            </thead>
                            <tbody class="sortable" id="mtbl">
                                {foreach $installed as $module}
                                    <tr data-title="перетащите модуль">
                                        <td>
                                            {if $modules['admin_file'] == 1}
                                                {if $module.name == 'shop'}
                                                    <a href="#">{$module.menu_name}</a>
                                                {else:}
                                                    <a href="#">{$module.menu_name}</a>
                                                {/if}
                                            {else:}
                                                <a href="#">{$module.menu_name}</a>
                                            {/if}
                                            <!--                                    <a href="#">Пользователи</a>-->
                                        </td>
                                        <td>
                                            <p>{$module.description}</p>
                                        </td>
                                        <td>
                                            <p>{if $module['enabled'] == "1"}{anchor($module.identif,$module.identif,array('target'=>'_blank'))}{else:}-{/if}</p>
                                        </td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="включить"  data-off="выключить">
                                                <span class="prod-on_off autoload_ch {if !$module.autoload}disable_tovar{/if}" data-mid="{$module.id}"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="выключить"  data-off="выключить">
                                                <span class="prod-on_off urlen_ch {if !$module.enabled}disable_tovar{/if}" data-mid="{$module.id}"></span>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            {else:}
                <h3>{lang('a_modules_not_installed')}</h3>
            {/if}
            <div class="tab-pane" id="set_modul">
                {if count($not_installed) > 0 }
                    <div class="row-fluid">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="span3">{lang('a_module')}</th>
                                    <th class="span3">{lang('a_desc')}</th>
                                    <th class="span2">{lang('a_version')}</th>
                                    <th class="span1">{lang('a_install')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $not_installed as $module}
                                    {var_dump($module)}
                                <tr>
                                    <td>
                                        <a href="#">{$module.menu_name}</a>
                                    </td>
                                    <td>
                                        <p>{$module.description}</p>
                                    </td>
                                    <td class="fdel">
                                        <p>{$module.version}</p>
                                    </td>
                                    <td class="fdel2">
                                        <a href="#" class="mod_instal" data-mname="{$module.com_name}" data-mid="{$module.id}">{lang('a_install')}</a>
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {else:}
                    {lang('a_no_modules_for_install')}
                {/if}
            </div>
        </div>
    </section>
</form>
