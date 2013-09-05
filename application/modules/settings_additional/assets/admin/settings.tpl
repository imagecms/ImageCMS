
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
        <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
            <thead>
            <th class="span1">{lang('Настройки', 'settings_additional')}</th>
            </thead>
            <tbody>

                <tr id="">
                    <td>
                    <form method="post" class="form-horizontal" id="saveMenu">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="row-fluid">
                                    <div class="control-group">
                                        <label class="control-label" for="menu_del">{lang('SubTemplate', 'settings_additional')}:</label>
                                        <div class="controls">                                           
                                            <select style="width:25% !important" name="substyle" id="menu_del">
                                                <option {if !$menu->del->href} selected="selected"{/if} value="0">{lang('--не определено--', 'settings_additional')}</option>
                                                {foreach $subStyle as $style}
                                                    <option value="{echo $style}" {if $data['substyle'] == $style} selected="selected" {/if} >{echo $style}</option>
                                                {/foreach}
                                            </select> 

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

