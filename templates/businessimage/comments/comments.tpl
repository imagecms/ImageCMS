<div class="g-section-m">
  <h2 class="g-section-m__title">
    {tlang('Comments')}
  </h2>
  <div class="g-section-m__item">

    <div class="b-comments">
      <!-- List of user comments -->
      {if $comments_arr}
      <div class="b-comments__list">
        {include_tpl('comments_list')}
      </div>
      {/if}
      <!-- Message if user must to sign in to leave a comment -->
      {if $can_comment == 1 && !$is_logged_in}
      <div class="b-comments__message_info">
        <p>{tlang('You have to log in to leave a comment.')} <a class="g-text" href="{site_url('auth')}">{tlang('Sign in')}</a></p>
      </div>      
      {else:}
      <!-- Main comment form  -->      
      <div class="b-comments__form">
        <div id="b-comments__form-anchor"></div>
        {include_tpl('main_form')}
      </div>
      {/if}
    </div>

  </div>
</div>