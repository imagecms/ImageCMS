{literal}
<script type="text/javascript">
function show_m_install_window(id)
{
        MochaUI.module_install_window = function(){
            new MochaUI.Window({
                id: 'mod_install_w',
                title:{/literal}{lang('Module install','admin')}{literal},
                type: 'modal',
                loadMethod: 'xhr',
                contentURL: base_url + 'admin/mod_search/display_install_window/' + id,
                width: 540,
                height: 480
            });
        }

        MochaUI.module_install_window();
}
</script>

<style>
    #modules_list_table th {
        font-weight:bold;
        background-color:#DCDCDC;
        background-image:url('{/literal}{$THEME}{literal}/images/form_button.png');
        padding:5px;
        color:#fff;
    }

    .mod_desc {}

    .mod_desc:hover {
        background-color:#F0F0F0;     
    }
</style>

{/literal}

<div class="top-navigation">
    <ul>
        <li>
        <form style="width:100%;" onsubmit="pages_table.filter(this.id); return false;">{lang('Search','admin')}:
                <input type="text" name="keyword"  />
                <input type="submit" value="{lang('Search','admin')}" class="button_green" onclick="showMessage('{lang("message","admin")}', '{lang("Module search is being developed","admin")}'); return false;" />
         {form_csrf()}
         </form>
        </li>
        <li>
            {if $install_type == 'ftp'}
                <span class="help-block">{lang("set write rights on the directory for simple module installation","admin")} ./application/modules/</span>
            {/if}
        </li>
    </ul>
</div>

<table border="0" width="100%" cellpadding="3" cellspacing="3">
<tr valign="top">
    <td>
        {if $action == 'list_modules'}
            {if count($modules) > 0}
                <table border="0" cellpadding="3" cellspacing="4" width="100%" id="modules_list_table">
                <thead>
                    <th>{lang("Name","admin")}</th>
                    <th>{lang("Version","admin")}</th>
                    <th>{lang("Description","admin")}</th>
                    <th>{lang("Actions","admin")}</th>
                </thead>

                {foreach $modules as $m}
                <tr valign="top" class="mod_desc">
                    <td style="min-width:150px;">{$m.name}</td>
                    <td style="min-width:50px;">{$m.version}</td>
                    <td style="min-width:300px;">{$m.description}</td>
                    <td width="100px;" align="right">
                        <div style="padding-right:50px;">
                        <a href="#" onclick="show_m_install_window({$m.id}); return false;">{lang("Install","admin")}</a>
                        </div>
                    </td>
                </tr>
                {/foreach}
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                    <div id="pagination">
                        {$pagination}
                    </div>
                    </td>
                    <td></td>
                </tr>
                </table>

            {else:}
                {lang("No modules have been found at your request","admin")}
            {/if}
        {/if}

        {if $action == 'main'}
    

                <table border="0" cellpadding="3" cellspacing="4" width="100%" id="modules_list_table">
                <thead>
                    <th>{lang("Module search","admin")}</th>
                </thead>

                
                <tr valign="top">
                    <td style="min-width:150px;">{lang("Here you can search for modules and set them to automatic mode","admin")}</td>
                </tr>
                
                </table>
        {/if}

    </td>

    <td width="200px" valign="top">

        <table border="0" cellpadding="3" cellspacing="4" id="modules_list_table">
        <thead>
            <th width="200px">{lang("Categories","admin")}</th>
        </thead>

        <tr valign="top" width="100%">
            <td>
            <!-- Category list -->
            {foreach $categories as $k}
                <a hreh="#" onclick="ajax_div('page', base_url + 'admin/mod_search/category/{$k.id}'); return false;">{$k.title}</a><br/>
            {/foreach}
            </td>
        </tr>

        </table>

    </td>
</tr>
</table>
