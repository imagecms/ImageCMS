{$Comments = $CI->load->module('comments')->init($pages)}
<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <h1>{$category.name}</h1>
            <div class="clearfix">
                <div class="left">
                    <div class="text">
                        {$category.short_desc}
                        {if $no_pages}
                            <p>{$no_pages}</p>
                        {/if}
                        <ul class="items items-blog items-row">
                            {foreach $pages as $page}
                                <li>
                                    <h2><a href="{site_url($page.full_url)}">{$page.title}</a></h2>  
                                    <span class="post-pub-info">
                                        {date('d-m-Y', $page.publish_date)} | 
                                        Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
                                        {if $tags = page_tags($page.id)} | Теги: {foreach $tags as $tag}
                                                <a href="{site_url('tags/search/'.$tag.value)}">{$tag.value}</a> 
                                        {/foreach}{/if}
                                    </span>

                                    {$page.prev_text}

                                    <div class="postinfo">
                                        <a href="{site_url($page.full_url)}#comments">{$Comments[$page.id]}</a> 
                                        &nbsp;&nbsp;
                                        <a href="{site_url($page.full_url)}">{lang('Читать дальше → ','corporate')}</a>
                                    </div>

                                    <div style="border-bottom:1px solid #ECECEC;">
                                        &nbsp;
                                    </div>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="aside-jaw">
                        <h3>Поиск</h3>
                        <div class="inside-padd">
                            <form action="{site_url('search')}" method="POST">
                                <div class="f_r m-l_5">
                                    <div class="btn s-p">
                                        <input type="submit" class="submit" value="ok"/>
                                    </div>
                                </div>
                                <div class="o_h">
                                    <input type="text" class="text" name="text" value="" placeholder="Поиск"/>
                                </div>
                                {form_csrf()}
                            </form>                            
                        </div>
                    </div>
                    <div class="aside-jaw">
                        <h3>Последние комментарии</h3>
                        <div class="inside-padd">
                            {widget('comments')}
                        </div>
                    </div>
                    <div class="aside-jaw">
                        <h3>Облако тегов</h3>
                        <div class="inside-padd">
                            {widget('tags')}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            {$pagination}
        </div>
    </div>
</div>
