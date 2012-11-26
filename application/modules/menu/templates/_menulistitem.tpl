<div class="row-category" >
    <div class="t-a_c">
        <span class="frame_label">
            <span class="niceCheck b_n">
                <input type="checkbox" name="ids" value="{$item.id}"/>
            </span>
        </span>
    </div>     
    <div>
        <p>{$item.id}</p>
    </div>
    <div class="share_alt">
        <!--<a href="#" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>-->
        <div class="title {if $item.parent_id > 0} lev {/if}">
            {if $item.hasKids}
                <button type="button" class="btn btn-small my_btn_s"
                        style="display: none;" data-rel="tooltip"
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
            <a href="/admin/components/cp/menu/edit_item/{$item.id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию" >{truncate($item.title, 100)}</a>
        </div>
    </div>
    <div>
        {$item.link}
    </div>
    <div>
        {$item.item_type}
    </div>
</div>
