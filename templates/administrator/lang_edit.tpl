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
                    <button type="submit" class="btn btn-small btn-primary formSubmit" data-form="#editLang" data-action="edit">
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
                                                <label class="control-label" for="inputName">{lang("Identifier","admin")}
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

                                            <div class="row-fluid">
                                                <!--<div class="control-group">
                                                        <label class="control-label" for="inputName">{lang("Image URL","admin")}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="image" id="" value="{$image}"/>
                                                        </div>
                                                    </div>-->
                                                <div class="control-group">
                                                    <label class="control-label" for="Img">
                                                        {lang("Image URL","admin")}:
                                                    </label>

                                                    <div class="controls">
                                                        <div class="group_icon pull-right">
                                                            {if MAINSITE != ''}
                                                                <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                                        return false;">
                                                                    <i class="icon-picture"></i>  {lang("Choose an image","admin")}
                                                                </button>
                                                            {else:}
                                                                <a href="{echo site_url('application/third_party/filemanager/dialog.php?type=1&field_id=Img');}" class="btn  btn-small iframe-btn" type="button">
                                                                    <i class="icon-picture"></i>
                                                                    {lang('Choose an image ','admin')}
                                                                </a>
                                                            {/if}
                                                            {/*<button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                            return false;"><i class="icon-picture"></i>  {lang("Choose an image","admin")}</button>
                                                            */}
                                                        </div>
                                                        <div class="o_h">
                                                            <input type="text" name="image" id="Img" value="{$image}" accept="image/gif, image/jpeg, image/png, image/jpg">
                                                        </div>
                                                    </div>
                                                </div>
                                                { /* }
                                                <div class="control-group">
                                                    <label class="control-label" for="inputParent">{lang("Template","admin")}
                                                        :</label>

                                                    <div class="controls">
                                                        <select name="template" {if $is_default}disabled="disabled"{/if}>
                                                            {foreach $templates as $template}
                                                                {if $is_default}
                                                                    <option {if $template == $template_installed} selected="selected" {/if} >{$template}</option>
                                                                {else:}
                                                                    <option {if $template == $template_selected} selected="selected" {/if} >{$template}</option>
                                                                {/if}
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                { */ }
                                            </div>
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