{foreach $images as $item}
    <a href="{$item.file_path}" title="{strip_tags(trim($item.description))}">
        <img src="{$item.thumb_path}" alt="{strip_tags(trim($item.description))}">
    </a>
{/foreach}