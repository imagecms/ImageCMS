<div id="titleExt" class="crumbs-custome">{widget('path')}</div>
<div class="custome-cat f-s_0 clearfix">
   <h1>Администрирование ImageCMS </h1>
   {foreach $pages as $page}
   <div class="col-6 col-sm-6 col-lg-4">
    <a href="{site_url($page.full_url)}">{$page.title}</a>
    <p>{truncate($page.prev_text,200)}</p>
 </div><!--/span-->
 {/foreach}
</div>
<div class="items-row" align="center">
  <ul class="pagination">
    {$pagination}
 </ul>
</div>