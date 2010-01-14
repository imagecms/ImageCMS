<div id="gallery_main_block">
    <div class="top-navigation">
    <ul style="float:left;">
        <li><p>Альбомы</p></li>
    </ul>
        <div align="right" style="float:right;padding:7px 13px;">
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;">Галерея</a> 
            > 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$category.id}'); return false;">{$category.name}</a>  
        </div>
    </div>

   <div style="clear:both"></div> 

    <div id="albums_list" style="padding:10px;">
        {if $albums}
        {foreach $albums as $item}
        <div style="padding:5px; border:1px solid silver; width:550px;background-color:#EDEDED;height:120px;margin-top:5px;">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td valign="top" width="200">
                        <div align="middle">
                        {if $item.cover_url != 'empty'}
                        <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$item.id}'); return false;">
                            <img src="{$item.cover_url}" style="border:5px solid #FFFFFF;" />
                        </a>
                        {else:}
                            <br/>
                            <b>Нет изображений</b>
                        {/if}
                        </div>
                    </td>
                    <td valign="top">
                        <div style="padding-left:10px;">
                            Имя: {$item.name}<br/>
                            Описание: {truncate(strip_tags($item.description), 55, '...')}<br/>
                            Создан: {date('Y-m-d H:i', $item.created)}<br/>
                            Обновлен: {if $item.updated != NULL} {date('Y-m-d H:i', $item.updated)}  {else:} 0000-00-00 00:00 {/if}<br/>
                            Просмотров: {$item.views}<br />
                            <p align="right">
                            <img src="{$THEME}/images/edit.png" onclick="ajax_div('albums_list', base_url + 'admin/components/cp/gallery/edit_album_params/{$item.id}'); return false;" title="Редактировать" style="cursor:pointer;" />
                            <img src="{$THEME}/images/images.png" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/edit_album/{$item.id}'); return false;" title="Просмотр Изображений" style="cursor:pointer;" />
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        {/foreach}

        {else:}
            <div id="notice">
                Альбомов не найдено.
            </div>
        {/if}
    </div>

</div> <!-- / gallery_main_block -->
