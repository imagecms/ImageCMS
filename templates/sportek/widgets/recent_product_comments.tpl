<div class="container">
<div class="box_title">Отзывы</div>
<div class="news">
	{foreach $comments as $comment}        
        {$pinfo = getPageinfo($comment.item_id)}        
        <div class="info_box">
            <span><a href="{shop_url('product')}/{$comment.item_id}"><img width="95" src="{media_url('uploads/shop')}/{echo$pinfo['0']['Smallimage']}"/></a></span>
                <dl>
                    <dt><a href="{shop_url('product')}/{$comment.item_id}">Палатка туристическая Easy Camp COMET 200</a></dt>
                    <dd><p>{$comment.text}</p></dd>
                </dl>
            </div>
	{/foreach}
</div>
</div>