<div class="g-container">
    <h1 class="b-content__title">
        {$category.name}
    </h1>
    {if trim($category.short_desc)}
    <div class="b-content__description g-text">
        {$category.short_desc}
    </div>
    {/if}

    <div class="g-row g-row_indent-20">
        <div class="g-col-9 g-col-12_from-m">
            {if count($pages) > 0}
            <div class="b-content__list">
                {foreach $pages as $page}
                <div class="b-content__item">

                    {if trim($page.field_image) != ""}
                    <div class="b-content__item-image">
                        <a href="{site_url($page.full_url)}"><img src="{$page.field_image}" alt="{$page.title}"></a>
                    </div>
                    {/if}
                            
                    <h2 class="b-content__item-title">
                        <a href="{site_url($page.full_url)}" class="b-content__item-title-link g-link">{$page.title}</a>
                    </h2>
                            
                    <div class="b-content__item-text g-text g-text_sub">
                        {$page.prev_text}
                        <div class="b-content__addinfo">
                            <!-- I've used display method instead of include_tpl, because I needed to add some extra data into template -->
                            {$CI->template->display('widgets/page_add_info', array(
                                'page'=>$page
                            ))}
                        </div>
                    </div>

                </div>
                {/foreach}
            </div>
            {else:}
                <p class="b-content__noitems g-text">
                    {tlang('There are no items to display. Please come back later!')}
                </p>
            {/if}
                        
            {if $pagination}
                <div class="b-content__pagination">
                    {$pagination}
                </div>
            {/if}  
        </div>
        <aside class="g-col-3 g-col-12_from-m">
            <div class="b-sidebar">
                {include_tpl('widgets/search_blog')}

                {include_tpl('widgets/sub_categories')}

                {widget('popular_blog_posts')}

                {widget('page_tag_cloud')}

                {widget('latest_comments')}
            </div>
        </aside>
        </div>
    </div>