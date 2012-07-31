{literal}
<style>
    .ticket_comment {
        width:500px;
        position:relative;
        margin-top:10px;
    }


    .ticket_comment_info0 {
        background-color:#CEE2E6;
        border-bottom:2px solid #A7B7BA; 
        padding:3px;
        height:22px;
    }

    .ticket_comment_info1 {
        background-color:#B9DD51;
        border-bottom:2px solid #A7B7BA; 
        padding:3px;
        height:22px;
    }

    .ticket_comment_author {
        float:left;
        font-size:16px;
        font-weight:bold;
        padding:3px;
    }

    .ticket_comment_date {
        font-size:12px;
        padding-top:4px;
    }

    .ticket_comment_text {
        padding:3px;
    }
</style>
{/literal}

<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><input type="button" class="button_silver_130" value="{lang('amt_all_tickets')}" onclick="ajax_div('page', base_url + 'admin/components/cp/user_support'); return false;" /></p>
        </li>
        </ul>
    </div>
</div>
<div style="clear:both"></div>

<div style="padding:10px;">
<form action="{site_url('admin/components/cp/user_support/update_ticket/' . $ticket.id)}" method="POST" id="ticket_info_{$ticket.id}">
<h3>{lang('amt_ticket_theme')}: {$ticket.theme}</h3>

    <fieldset class="fieldset">
        <table cellspacing="1" cellpadding="4" border="0" width="100%">
          <tbody><tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_ticket_num')}:</span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{$ticket.id}</span></td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_dep')}: </span></td>
            <td align="left" width="35%" valign="top">
                <select name="department">
                {foreach $departments as $row}
                <option value="{$row.id}" {if $row.id == $ticket.department}selected="selected"{/if}>{$row.name}</option>
                {/foreach}
                </select> 
            </td>
          </tr>
          <tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_status')}: </span></td>
            <td align="left" width="35%" valign="top">
                <select name="status">
                {foreach $statuses as $k => $v}
                <option value="{$k}" {if $k == $ticket.status}selected="selected"{/if} style="color:{get_status_color($k)}">{get_status_text($k)}</option>
                {/foreach}
                </select>
            </td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_imp')}: </span></td>
            <td align="left" width="35%" valign="top">
                <select name="priority">
                {foreach $priorities as $k => $v}
                <option value="{$k}" {if $k == $ticket.priority}selected="selected"{/if} style="color:{get_priority_color($k)}">{get_priority_text($k)}</option>
                {/foreach}
                </select> 
            </td>
          </tr>
          <tr>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_cr')}: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{date('l, d F H:i', $ticket.date)}</span></td>
            <td align="left" width="20%" valign="top" class="row2"><span class="smalltext">{lang('amt_up')}: </span></td>
            <td align="left" width="35%" valign="top"><span class="smalltext">{date('l, d F H:i', $ticket.updated)}</span></td>
          </tr>
          </tbody></table>
    </fieldset>

    <br/>

    <div align="right">
         <button type="submit" class="button" onclick="ajax_me('ticket_info_{$ticket.id}');">{lang('amt_save')}</button> 
    </div>

    <h3>{lang('amt_description')}</h3>
    <p>
    {$ticket.text}
    </p>

</form>

    <br/>
    {if $ticket.comments}
    <h3>{lang('amt_corresp')}</h3>
 
    {foreach $ticket.comments as $c}
    <div class="ticket_comment" id="ticket_comment_div_{$c.id}">

    <div class="ticket_comment_info{$c.user_status}">
        <div class="ticket_comment_author">{$c.user_name}</div>    
        <div class="ticket_comment_date" align="right">
            {lang('amt_added')}: {date('l, d F H:i', $c.date)}
           <img onclick="confirm_ticket_comment({$c.id});" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="{lang('amt_delete')}" />     
        </div>
    </div>

        <div class="ticket_comment_text" style="clear:both;">{$c.text}</div>
    </div>
    {/foreach}
    {/if}

<p>
<br/>
<h3>{lang('amt_leave_message')}</h3>
    <form action="{site_url('admin/components/cp/user_support/add_comment/' . $ticket.id)}" method="POST" id="add_ticket_comment_{$ticket.id}">
        <div class="form"> 
        <p>
            <textarea style="width:400px;" class="textarea" name="text"></textarea>
            <br />
            <br />
            <button type="submit" class="button" onclick="ajax_me('add_ticket_comment_{$ticket.id}');">{lang('amt_send')}</button> 
        </p>
        </div>
    </form>
</p>
</div>

{literal}
<script type="text/javascript">

function confirm_ticket_comment(id)
{
    alertBox.confirm('<h1>Удалить комментарий ID' + id + '?</h1>', {onComplete:
        function(returnvalue) {
        if(returnvalue)
        {
            var req = new Request.HTML({
                method: 'post',
                url: base_url + 'admin/components/cp/user_support/delete_comment/',
                evalResponse: true,
                onComplete: function(response) {  
                    $('ticket_comment_div_' + id).setStyle('display', 'none');
                }
            }).post({'id': id});
        }
        else
        {

        }
        }
    });
}

</script>
{/literal}
