<div class="container">
    <form method="post" action="#">
        <ul class="breadcrumb">
            <li><a href="#">Главная</a> <span class="divider">/</span></li>
            <li class="active">Категории</li>
        </ul>
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">Категории</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small disabled action_on" ><i class="icon-trash"></i>Удалить</button>
                        <button type="button" class="btn btn-small btn-success" ><i class="icon-plus-sign icon-white"></i>Создать категорию</button>
                    </div>
                </div>                            
            </div>
            <div class="frame_table">
                <div id="category">
                    <div class="row-category head">
                        <div class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </div>
                        <div>{lang('a_id')}</div>
                        <div>{lang('a_title')}</div>
                        <div>{lang('a_url')}</div>
                        <div>{lang('a_pages')}</div>
                    </div>
                    <div class="body_category">

                        <div>
                            {sub_categories_admin($tree)}
                            {foreach $tree as $item}         
{if $item.parent_id == "0"}
                                <div class="frame_level_0 sortable" >                                                                   
                                    <div class="row-category" >
                                        <div class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </div>                                             	
                                        <div><p>{$item.id}</p></div>
                                        <div class="share_alt" >
                                            <a href="#" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>
                                            <div class="title" onclick="edit_category({$item.id}); return false;">
                                                <button type="button" class="btn btn-small my_btn_s" style="display: none; margin-top: 1px;" data-rel="tooltip" data-placement="top" data-original-title="свернуть категорию">
                                                    <i class="my_icon icon-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-small my_btn_s btn-primary" data-rel="tooltip" data-placement="top" data-original-title="розвернуть категорию">
                                                    <i class="my_icon icon-plus"></i>
                                                </button>                                  
     <a href="{$ADMIN_URL}edit/{$item.id}" data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию" >{truncate($item.name, 100)}</a>
                                               

                                            </div>
                                        </div>
                                        <div><a href="{$BASE_URL}{$item.path_url}" target="_blank">{truncate($item.url, 75)}</a></div>
                                        <div><p>{$item.pages}</p></div>                                                
                                    
                                     {else:}
                {for $i=0;$i<=$item.level;$i++}
                    
                {/for}
                
                                    <div class="frame_level_{echo $item.level} sortable">                                                                   
                                    <div class="row-category">
                                        <div class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox"/>
                                                </span>
                                            </span>
                                        </div>                                             	
                                        <div><p>{$item.id}</p></div>
                                        <div class="share_alt">
                                            <a href="#" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>
                                            <div class="title lev_{echo $item.level}">
                                                <button type="button" class="btn btn-small my_btn_s" style="display: none; margin-top: 1px;" data-rel="tooltip" data-placement="top" data-original-title="свернуть категорию">
                                                    <i class="my_icon icon-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-small my_btn_s btn-primary" data-rel="tooltip" data-placement="top" data-original-title="розвернуть категорию">
                                                    <i class="my_icon icon-plus"></i>
                                                </button>                                  
     <a href="#" data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию">{truncate($item.name, 100)}</a>
                                               

                                            </div>
                                        </div>
                                        <div><a href="{$BASE_URL}{$item.path_url}" target="_blank">{truncate($item.url, 75)}</a></div>
                                        <div><p>{$item.pages}</p></div>                                                
                                    </div>
                                     {/if}
                                    </div>
                                {/foreach}
                            </div>


                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="pagination pull-left">
                        <ul>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><span>...</span></li>
                            <li><a href="#">4</a></li>
                        </ul>
                    </div>
                    <div class="pagination pull-right">
                        <ul>
                            <li class="disabled"><span>Prev</span></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
        </section>
    </form>
</div>
<div class="hfooter"></div>
</div>
{literal}
    <script type="text/javascript">
            window.addEvent('domready', function(){
                    pages_table = new sortableTable('pages_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
    pages_table.altRow();
            });
    </script>
{/literal}