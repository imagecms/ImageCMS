{literal}
    <style type="text/css">
        .br {border: 1px solid red}
    </style>
{/literal}
<div class="container">

    <section class="mini-layout">


        <div class="frame_title clearfix" style="top: 179px; width: 1168px;">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Модуль дополнительных настроек', 'settings_additional')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Назад', 'settings_additional')}</span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveMenu" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('Сохранить', 'settings_additional')}</button>
                </div>
            </div> 
        </div>
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="/admin/components/init_window/settings_additional/heder" class="btn btn-small">Править шапку сайта</a>
                <a href="/admin/components/init_window/top_menu_additional" class="btn btn-small">Top menu</a>
                <a href="/admin/widgets_manager/edit_html_widget/16" class="btn btn-small">Infobox1</a>
                <a href="/admin/widgets_manager/edit_html_widget/17" class="btn btn-small">Infobox2</a>
                <a href="#" class="btn btn-small" onclick="zoomOn()">Вкл/Выкл ZoomWindow</a>



            </div>
        </div>
        <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
            <thead>
            <th class="span1">{lang('Настройки шаблонов и оформления', 'settings_additional')}</th>
            </thead>
            <tbody>

                <tr id="">
                    <td>
                        <form method="post" class="form-horizontal" id="saveMenu">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">


                                        <div class="control-group">
                                            <label class="control-label" for="template">{lang('Template', 'settings_additional')}:</label>
                                            <div class="controls templ">  
                                                {foreach $templ as $style}
                                                    <img  class="{if $style == $data['templ']}br{/if}" data-templ="{echo $style}" onclick="changelogo(this)" id="logo" style="max-width: 200px; padding: 5px" src="{echo '/templates/' . $style}/screenshot.png"/>
                                                {/foreach}
                                                <input type="hidden" name="templ" value="{echo $data['templ']}">
                                                {/*}
                                                <select onchange="changelogo(this)" style="width:25% !important" name="templ" id="template">
                                                    {foreach $templ as $style}
                                                        <option value="{echo $style}" {if $data['templ'] == $style} selected="selected" {/if} >{echo $style}</option>
                                                    {/foreach}
                                                </select> 
                                                { */}


                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label" for="substyle">SubTemplate:</label>
                                            <div class="controls substyle">  
                                                {foreach $subStyle as $style}
                                                    <img  class="{if $style == $data['substyle']}br{/if}" data-substyle="{echo $style}" onclick="changesublogo(this)" id="logo" style="max-width: 200px; padding: 5px" src="/templates/{echo $data['templ']}/stylesets/{echo $style}/screenshot.png" />
                                                {/foreach}
                                                <input type="hidden" name="substyle" value="{echo $data['substyle']}">

                                                {/*}
                                                <select onchange="changesublogo(this)" style="width:25% !important" name="substyle" id="substyle">
                                                    <option {if !$data['substyle']} selected="selected"{/if} value="0">{lang('--не определено--', 'webinger')}</option>
                                                    {foreach $subStyle as $style}
                                                        <option value="{echo $style}" {if $data['substyle'] == $style} selected="selected" {/if} >{echo $style}</option>
                                                    {/foreach}
                                                </select>
                                                { */}

                                                <span class="help-block">{lang('Для работы дополнительных стилей надо, чтоб они были установлен для каждого из шаблонов', 'webinger')}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {form_csrf()}
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>

