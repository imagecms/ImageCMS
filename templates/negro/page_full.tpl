<div class="inside">
    <div class="container">
        {getPageCategoryPath($page.id, $delim = " / ", $is_page = true)}
        <div class="clearfix">
            <div class="text">
                <h1>{echo encode($page.title)}</h1>
                {$page.full_text}
            </div>
        </div>
    </div>
</div>