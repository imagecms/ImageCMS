<div class="top-navigation">
    <ul>
        <li><p>Журнал событий</p></li>
    </ul>
</div>

<div id="admin_logs" style="padding:10px;">
{foreach $messages as $m}
    <div style="float:left;min-width:100px;padding-right:5px;">
        <span style="padding-right:3px;" class="lite">{date('d-m-Y H:i:s', $m.date)}</span>
        <a href="#" onclick="return false;">{$m.username}</a>:
    </div>
    <div class="log_message" style="float:left;">{$m.message}</div>

    <div style="clear:both;"></div> 
{/foreach}
</div>

    
<div style="padding-left:15px;" class="pagination">{$paginator}</div>
