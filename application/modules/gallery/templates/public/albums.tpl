{literal}
<style>
   .albums_list {
        position:relative;
    }

    .albums_list ul { 
        list-style:none;
        text-align:left;
    }

    .albums_list li {
        margin:0;
        float:left;
        display:table-cell;
        width:200px;
        height:150px;
        padding:5px;
    }

    .albums_list p {
        padding:0;
        margin:0;
    }

    .date {
        font-size:10px;
        display:block;
    }
</style>
{/literal}

<h1>Альбомы</h1>

{if is_array($albums)}
    <div class="albums_list">
    <ul>   
    {foreach $albums as $album}     
    <li>   
        <a href="{site_url('gallery/album/' . $album.id)}"><img src="{$album.cover_url}" border="0" style="border:5px solid #fff;" /></a>
        <br/>
        <a href="{site_url('gallery/album/' . $album.id)}">{$album.name}</a>
        <p>
            {truncate($album.description, 50)}
            <span class="date">
                {date('Y-m-d', $album.updated)}
            </span>
        </p>
    </li>
    {/foreach}
    </ul>
    </div>

{else:}
    Альбомов не найдено.
{/if}
