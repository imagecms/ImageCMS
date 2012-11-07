<div class="row-category" >
    <div class="t-a_c">
        <span class="frame_label">
            <span class="niceCheck b_n">
                <input type="checkbox" name="ids" value="{$item.id}"/>
            </span>
        </span>
    </div>                                             	
    <div><p>{$item.id}</p></div>
    <div class="share_alt" >
        <a href="#" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-   share-alt"></i></a>
        <div class="title {if $item.parent_id > 0} lev {/if}" onclick="edit_category({$item.id}); return false;">
            
            {if count($item.subtree)}
            <button type="button" class="btn btn-small my_btn_s"
            style="display: none; margin-top: 1px;" data-rel="tooltip"
            data-placement="top" data-original-title="свернуть категорию">
            <i class="my_icon icon-minus"></i>
            </button>
            <button type="button" class="btn btn-small my_btn_s btn-primary"
            data-rel="tooltip" data-placement="top"
            data-original-title="розвернуть категорию">
            <i class="my_icon icon-plus"></i>
            </button>
            {else:}
            <span class="simple_tree">↳</span>
            {/if}

            <a href="{$ADMIN_URL}edit/{$item.id}" data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию"  class="pjax">{truncate($item.name, 100)}</a>

        </div>
    </div>
    <div><a href="{$BASE_URL}{$item.path_url}" target="_blank">{truncate($item.url, 75)}</a></div>
    <div><p>{$item.pages}</p></div>
 </div>