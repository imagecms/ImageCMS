<h3>Последние отзывы</h3>
<div class="news">
	{foreach $comments as $comment}
		<div class="newsitem">
			<span>{$comment.user_name}({date('j.m.Y h:i',$comment.date)})</span>
			<p>{$comment.text} <a href="{shop_url('product')}/{$comment.item_id}#comment_{$comment.id}">&rarr;</a></p>			
		</div>
	{/foreach}
</div>