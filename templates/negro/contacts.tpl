<div class="inside">
    <div class="container">
        {getPageCategoryPath($page.id, $delim = " / ", $is_page = true)}
        <div class="clearfix">
            <div class="text">
                <h1>{echo encode($page.title)}</h1>
                {$men = getmen()}
                {if count($men) > 0}
                <div class="contact-list">
                    <ul>
                        {$i = 1}
                        {foreach $men as $item}
                        {$item = $CI->load->module('cfcm')->connect_fields($item, 'page')}
                        <li class="{chose_class_men($i)}">
                            <div class="title">{$item.title}</div>
                            <div class="cont-body clearfix">
                                {if $item.field_photo}
                                <div class="f_l photo-contact">
                                    <img src="{str_replace('\\','/',$item.field_photo)}" style="width:155px;height:194px">
                                </div>
                                {/if}
                                <div class="contact-info">
                                    {$item.full_text}
                                </div>
                            </div>
                        </li>
                        {$i++}
                        {/foreach}
                    </ul>
                </div>
                {/if}
            </div>
        </div>
    </div>
</div>