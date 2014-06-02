<div class="row-category" >
    <div class="t-a_c">
        <span class="frame_label">
            <span class="niceCheck b_n">
                <input type="checkbox" name="ids" value="{$item.id}"/>
            </span>
        </span>
    </div>       
    <div><p>{$item.id}</p></div>
    <div><div class="title {if $item.parent_id > 0} lev {/if}" >
            {if count($item.subtree)}
                <button type="button" class="btn btn-small my_btn_s"
                        style="display: none;" data-rel="tooltip"
                        data-placement="top" data-original-title="{lang('roll up category','admin')}">
                    <i class="my_icon icon-minus"></i>
                </button>
                <button type="button" class="btn btn-small my_btn_s btn-primary"
                        data-rel="tooltip" data-placement="top"
                        data-original-title="{lang('expand category','admin')}">
                    <i class="my_icon icon-plus"></i>
                </button>
            {else:}
                <span class="simple_tree">↳</span>
            {/if}
            <a href="/admin/categories/edit/{$item.id}" data-rel="tooltip" data-placement="top" data-original-title="{lang('edit category','admin')}"  class="pjax">{truncate($item.name, 100)}</a>
        </div></div>
    <div class="share_alt" >
        <a href="{$BASE_URL}{$item.path_url}" target="_blank" class="f_l">{truncate($item.url, 75)}</a>
        <a target="_blank" href="{$BASE_URL}{$item.path_url}" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="{lang('go to the website','admin')}"><i class="icon-share-alt"></i></a>
    </div>
    <div><p>{$item['pages']}</p></div>
</div>