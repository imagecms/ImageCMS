<ul>
{$count = 0}
{foreach $comments as $comment}
            <li {if $count == 0} class="first" {/if}>
            	<a href="{site_url($comment.url)}#comment_{$comment.id}"><em>{date('d.m.Y H:i',$comment.date)}<b>{$comment.user_name}</b></em>{$comment.text}</a>
            </li>     
{$count++}            
{/foreach}
</ul>
