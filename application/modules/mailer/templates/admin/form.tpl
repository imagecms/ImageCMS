<div id="shopSettingsTabs">  

<h4 title="Отправка писем">Отправка писем</h4>
<div class="top-navigation">
    <ul>
        <li><a class="send_email">Отправка писем</a></li
    </ul>


<form action="{$BASE_URL}admin/components/cp/mailer/send_email" method="post" id="send_mail_form" style="width:100%;">

<div class="form_text">{lang('amt_theme')}:</div>
<div class="form_input">
    <input type="text" name="subject" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_your_name')}:</div>
<div class="form_input">
    <input type="text" name="name" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_your_email')}:</div>
<div class="form_input">
    <input type="text" name="email" value="{$admin_mail}" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_message')}:</div>
<div class="form_input">
    <textarea name="message" rows="15" cols="180"  style="width:700px;height:350px;">{lang('amt_hello')}.






--------------------------------
{lang('amt_best_regards')} {$site_settings.site_title}

{site_url()}

</textarea> 
</div>
<div class="form_overflow"></div>


<div class="form_overflow"></div>

<div class="form_text">{lang('amt_format')}:</div>
<div class="form_input">
    <select name="mailtype">
        <option value="html" selected="selected">{lang('amt_html')}</option>
        <option value="text">{lang('amt_plain_text')}</option>
    </select>
</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="Отправить" onclick="ajax_me('send_mail_form');" />
</div>

</form>

</div>
  <h4 title="Пользователи">Пользователи</h4>
  <div class="top-navigation">
    <ul>
        
        <li><p>Пользователи</p></li>
    </ul>
    <div >
        <div id="sortable">
  <table id="ShopUsersTable">
    <thead>
        <tr>
            
           
            <th>ID</th>
            <th class="tableHeaderOver">Email</th>
            <th class="tableHeaderOver">Дата подписки</th>
            <th width="16px"></th>
        </tr>
    </thead>
    <tbody>
    {foreach $all as $u}
        <tr >
            <td title="{lang('a_ID')}">{echo $u['id']}</td>
            <td title="{lang('a_email')}">{echo $u['email']}</td>
            <td title="Дата">{echo date("d-m-Y H:i:s",$u['date'])}</td>       
            <td {if $u['id'] != ShopCore::$ci->dx_auth->get_user_id()}title="{lang('a_delete')}"><img onclick="confirm_shop_delete_user({echo $u['id']});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" />{else:}>{/if}</td>
        </tr>
    {/foreach}
    </tbody>

</table>
    <div id="gopages" class="navigation">
  
</div>
    </div>
</div>
</div>
{literal}
    </div>
    <script type="text/javascript">
        
		var SSettings_tabs = new SimpleTabs('shopSettingsTabs', {
		    selector: 'h4'
		});

		function setSystemTemplate(el, path)
		{
		    $('systemTemplatePath').value = path;
		    $$('.templateScreenshot img').removeClass('active');
		    el.addClass('active');
		}
                       window.addEvent('domready', function(){
    var ShopUsersTable = new sortableTable('ShopUsersTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
    ShopUsersTable.altRow();
    });

   window.addEvent('domready', function(){
    var ShopUsersTable = new sortableTable('ShopUsersTable', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
    ShopUsersTable.altRow();
    });

    function confirm_shop_delete_user(id)
    {
        alertBox.confirm('<h1>{/literal}{lang('a_delete')} {lang('a_users')} {lang('a_ID')}: ' + id + '? </h1>'{literal}, {
            onComplete:
                function(returnvalue) 
                {
                    if(returnvalue)
                    {
                        $('userRow' + id).setStyle('background-color','#D95353');
                        var req = new Request.HTML({
                            method: 'post',
                            url: shop_url + 'admin/delete',
                            evalResponse: true,
                            onComplete: 
                                function(response) {  
                                $('userRow' + id).dispose();
                                if ($$('#ShopUsersTable tbody tr').length == 0)
                                {
                                    ajaxShop('admin/index'); 
                                }
                            }
                        }).post({'userId': id});
                    }
                }
        });
    }
        </script>
        
{/literal}


