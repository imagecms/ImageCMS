<li {if $parent}parent="{echo $parent}"{/if} 
                identifier="{echo $item['identifier']}" 
                text="{echo $item['text']}"
                link="{echo $item['link']}" 
                item_class="{echo $item['class']}"
                item_id="{echo $item['id']}"
                pjax="{echo $item['pjax']}"
                icon="{echo $item['icon']}"
                divider="{echo $item['divider']}"
                >
    {echo lang($item['text'], 'admin')}
</li>