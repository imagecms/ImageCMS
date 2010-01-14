    <div style="float:right;margin:20px;">
        <span class="gray">Автор: {$page.author}, Опубликовано: {date('d-m-Y H:i', $page.publish_date)}</span>
    </div>
    <h2 class="title">{$page.title}</h2>
    <div class="inner"> 
        <p class="first">
            {$page.full_text}
        <a href="javascript: history.go(-1);">{lang('history_back')}</a>        
        </p>
    </div> 
    <hr/>

    {$comments}
