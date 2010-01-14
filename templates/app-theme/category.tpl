<!-- Display if no pages -->
{if $no_pages}
    <div class="flash" style="padding: 20px;">
    <div class="message warning">
        <p>{$no_pages}</p>
    </div>
    </div>
{/if}

<!-- pages list -->
{foreach $pages as $page}
    <div style="float:right;margin:20px;">
        <span class="gray">Автор: {$page.author}, Опубликовано: {date('d-m-Y H:i', $page.publish_date)}</span>
    </div>
    <h2 class="title"><a href="{site_url($page.full_url)}">{$page.title}</a></h2>
    <div class="inner"> 
        <p class="first">
            {$page.prev_text}            

        {if ($tags = page_tags($page.id)) != FALSE}
        <p>{lang('lang_tags')}: {foreach $tags as $tag} <a href="#">{$tag.value}</a> {/foreach} </p>
        {/if}
        
        <a href="{site_url($page.full_url)}">{lang('full_article')}</a>
        </p>
    </div> 
    <hr/>
{/foreach}

<!-- pagination -->
<div class="actions-bar">
    <div class="pagination">&nbsp; {$pagination} &nbsp;</div>
</div>
<!-- -->

<p>&nbsp;</p>
