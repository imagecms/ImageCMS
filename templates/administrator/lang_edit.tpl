<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Language edit","admin")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/languages" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span> 
                        <span class="t-d_u">
                            {lang("Go back","admin")}
                        </span>
                    </a>
                    <button type="submit" class="btn btn-small btn-primary formSubmit" data-form="#editLang"
                            data-action="edit">
                        <i class="icon-ok icon-white"></i>
                        {lang("Save","admin")}
                    </button>
                    <button type="submit" class="btn btn-small formSubmit" data-form="#editLang" data-action="close">
                        <i class="icon-check"></i>
                        {lang("Save and go back","admin")}
                    </button>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="parameters">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Settings","admin")}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <form action="{$BASE_URL}admin/languages/update/{$id}" method="post" id="editLang">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="inputName">{lang("Language","admin")}:
                                                    <span class="must">*</span></label>

                                                <div class="controls">
                                                    <input type="text" name="lang_name" id="" value="{$lang_name}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"
                                                       for="inputName">{lang("Identifier","admin")}
                                                    : <span class="must">*</span></label>

                                                <div class="controls">
                                                    <input type="text" name="identif" id="" value="{$identif}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="locale">{lang("Localization","admin")}
                                                    :</label>

                                                <div class="controls">
                                                    <select id="locale" name="locale">
                                                        {foreach $locales as $locale_name}
                                                            <option {if $locale_name == $locale} selected="selected" {/if} >{echo $locale_name}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>

                                            {if !$is_default}
                                                <div class="control-group">
                                                    <div class="span3 d-i_b">
                                                        {if $is_active}
                                                            {$checked = 'checked="checked"';$checkedP = '';}
                                                        {else:}
                                                            {$checkedP = 'disable_tovar';$checked = '';}
                                                        {/if}
                                                        <label class="control-label" for="locale">{lang("Active","admin")}
                                                            :</label>

                                                        <div class="controls">
                                                            <div class="frame_prod-on_off v-a_m" data-rel="tooltip" data-placement="top" data-original-title="{lang('show','admin')}">
                                                                <span class="prod-on_off {echo $checkedP;}" data-id=""></span>
                                                                <input type="checkbox" name="active" value="1" {echo $checked;} style="display: none;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/if}

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div id="elFinder"></div>