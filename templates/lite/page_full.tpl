<div>
    <h2>{$page.title}</h2>

    {$page.full_text}

    <p>
        <a href="javascript: history.go(-1);">{lang('history_back')}</a> 
    </p>

    <div class="postbot">
        <div class="date">{date('d-m-Y H:i', $page.publish_date)} | Раздел: <a href="{site_url($category.path_url)}">{$category.name}</a></div>
        <div class="commentsnum">Комментарии ({$page.comments_count})</div>
    </div>
</div>

<div id="comments">
    {$comments}
</div>
