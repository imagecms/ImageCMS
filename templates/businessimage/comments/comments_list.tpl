{foreach $comments_arr as $comment}
<div class="b-comments__post">
	<div class="b-comments__post-header">
		<h3 class="b-comments__post-author">{$comment.user_name}</h3>
		<time class="b-comments__post-date" datetime="{date('Y-m-d\TH:i', $comment.date)}">{locale_date("d F Y H:i", $comment.date)}</time>
		<div class="b-comments__post-rate">
			<div class="b-star-number g-clearfix">
				{for $i = 1; $i <= 5; $i++}
					{if $i <= $comment.rate}
					<i class="b-star-number__ico fa fa-star" title="{$comment.rate} {tlang('out of 5 stars')}"></i>
					{else:}
					<i class="b-star-number__ico fa fa-star-o" title="{$comment.rate} {tlang('out of 5 stars')}"></i>
					{/if}
				{/for}
			</div>
		</div>
	</div>
	<div class="b-comments__post-text g-text">{$comment.text}</div>
	<div class="b-comments__post-vote">
		<a class="b-comments__post-vote-item" href="{media_url('/comments/setyes/'.$comment.id)}" title="{tlang('Like')}">
			<i class="b-comments__post-vote-ico fa fa-thumbs-o-up"></i>
			<span class="b-comments__post-vote-count">{$comment.like}</span>
		</a>
		<a class="b-comments__post-vote-item" href="/comments/setno/{$comment.id}" title="{tlang('Dislike')}">
			<i class="b-comments__post-vote-ico fa fa-thumbs-o-down"></i>
			<span class="b-comments__post-vote-count">{$comment.disslike}</span>
		</a>
	</div>
</div>
{/foreach}
