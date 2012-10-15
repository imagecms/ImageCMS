<div class="row-category" data-title="перетащите категорию" data-rel="tooltip" data-placement="left">
    <div class="t-a_c">
        <span class="frame_label"> <span class="niceCheck b_n">
                <input name="id" type="checkbox" value="{echo $cat->id}"/>
            </span>
        </span>
    </div>
    <div>
        <p>{echo $cat->id}</p>
    </div>
    <div class="share_alt">
        <a href="{shop_url('category/'.$cat->url)}" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт" target="blank"><i class="icon-share-alt"></i></a>

        <div class="title lev">
            {if $cat->hasChilds}
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

            <a href="{$ADMIN_URL}categories/edit/{echo $cat->id}" class="pjax" data-rel="tooltip" data-placement="top" data-original-title="редактировать категорию">{echo $cat->name}</a>
        </div>
    </div>
    <div>
        <p>
            <a href="{shop_url('category/'.$cat->url)}" target="blank"> {echo $cat->url} </a>
        </p>
    </div>
    <div style="width: 8%;">
        <p>{echo $cat->myProdCnt}{if $cat->hasChilds} ({echo $cat->prodCnt}) {/if}</p>
    </div>
    <div>
        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
            <span class="prod-on_off cat_change_active{if !$cat->active} disable_tovar{/if}" data-id="{echo $cat->id}"></span>
        </div>
    </div>
</div>