
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('sett')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#settings_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                
            </div>
        </div>                            
    </div>
    <div class="row-fluid">

        <div class="content_big_td">
            <form id="settings_form" action="/admin/components/init_window/mobile/update" method="post">
                <div class="tab-pane" id="mobile">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('a_mobile_version')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="control-group">
                                            <div class="control-label"></div>
                                            <div class="controls">
                                                <span class="frame_label no_connection" onclick="this.parentNode.children[1].value = (this.parentNode.children[1].value == 0) ? 1 : 0;">
                                                    <span class="niceCheck b_n">
                                                        <input type = "checkbox" {if $MobileVersionON}checked="checked"{/if}/>
                                                    </span>
                                                    Включить
                                                </span>
                                                <input type = "hidden" name = "MobileVersionON" value = "{echo (int)$MobileVersionON}"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Домен полной версии:</label>
                                            <div class="controls">
                                                <input type = "text" name = "MobileVersionSite" value = "{echo $MobileVersionSite}"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Домен мобильной версии:</label>
                                            <div class="controls">
                                                <input type = "text" name = "MobileVersionAddress" value = "{echo $MobileVersionAddress}"/>
                                            </div>
                                        </div>
                                        <!--                                            <div class="control-group">
                                                <label class="control-label">Шаблон:</label>
                                                <div class="controls">
                                        
                                        {if $mobileTemplates}
                                            <ul class="thumbnails">
                                            {foreach $mobileTemplates as $mt}
                                                {if file_exists($mt . '/screenshot.png')}
                                                    <li>
                                                        <a class="thumbnail active select_mobile_tpl" data-path="{echo $mt}">
                                                            <img src="{echo substr_replace($mt . '/screenshot.png', '', 0, 1)}" width="100" height="100"
                                                                 alt="{$mt}"
                                                                 title="{$mt}"
                                                                 class="mobile_tpl_image {if $mt == $mobileTemplatePath}sel_template{/if}"
                                                                 />
                                                        </a>
                                                    </li>
                                                {/if}
                                            {/foreach}
                                        </ul>
                                        {else:}
                                            {lang('a_list')} {lang('a_pattern')} {lang('a_empty')}.
                                        {/if}
                                        
                                    </div>
                                </div>-->
                                        <div class="control-group">
                                            <label class="control-label">Шаблон:</label>
                                            <div class="controls">
                                                {if $mobileTemplates}
                                                    <select name="mobileTemplatePath" class="input-long">
                                                        {foreach $mobileTemplates as $mt}
                                                            {$name = explode('/',$mt)}
                                                            <option value="{$mt}" {if $mt == $mobileTemplatePath}selected="selected"{/if}>{echo $name[2]}</option>
                                                        {/foreach}
                                                    </select>
                                                {else:}
                                                    {lang('a_list')} {lang('a_pattern')} {lang('a_empty')}.
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>