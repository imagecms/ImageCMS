<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="text left">
                <h1>{$page.title}</h1>
                <div class="description">
                    {$page.full_text}
                </div>
                {$comments}
            </div>
            <div class="right">
                {widget('offers_all')}
            </div>
        </div>
    </div>
</div>