<!-- Checking error in main comment, not in answer form -->
{$loc_main_comment_error = !$parent_id && $validation_errors}

<form class="g-form-m g-form-m_main" action="{echo $locale}/comments/addPost#b-comments__form-anchor" method="post">

  <!-- Messages BEGIN -->
  {if $loc_main_comment_error}
    <div class="g-form-m__message g-form-m__message_error">
      {foreach $validation_errors as $message}
        <p class="g-form-m__message-item">{$message}</p>
      {/foreach}
    </div>
  {/if}
  {if $answer == 'sucesfull' && !$use_moderation}
    <p class="g-form-m__message g-form-m__message_success">{tlang('Your comment has been successfully published')}</p>
  {/if}
   {if $answer == 'sucesfull' && $use_moderation}
    <p class="g-form-m__message g-form-m__message_success">{tlang('Your comment will be published after moderation ')}</p>
  {/if}
  <!-- END Messages -->


  <div class="g-row g-row_indent-20">
    <div class="g-col-6">
      <!-- Name field input BEGIN -->
      {if !$is_logged_in}
      <div class="g-form-m__field">
        <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Name')}</div>
        <div class="g-form-m__field-section">
          <input class="g-form-m__field-input" type="text" name="comment_author" value="{$old_author}" placeholder="{tlang('Name')}" required>
        </div>
      </div>
      {else:}
      <div class="g-form-m__field g-form-m__field_title-left">
        <div class="g-form-m__field-title">{tlang('Name')}</div>
        <div class="g-form-m__field-section">{echo $CI->dx_auth->get_username()}</div>
      </div>
      {/if}
      <!-- END Name field input -->
    </div>
    {if !$is_logged_in}
    <div class="g-col-6">
      <!-- Email field input BEGIN -->
      <div class="g-form-m__field">
        <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('E-mail')}</div>
        <div class="g-form-m__field-section">
          <input class="g-form-m__field-input" type="email" name="comment_email" value="{$old_email}" placeholder="{tlang('E-mail')}" required>
      </div>
      </div>
      <!-- END Name field input -->
    </div>
    {/if}
  </div>

  <!-- Rating field BEGIN -->
  <div class="g-form-m__field g-form-m__field_title-left">
    <div class="g-form-m__field-title">{tlang('Rating')}</div>
    <div class="g-form-m__field-section">
      <div class="b-star-rating">
        <div class="b-star-rating__wrap">
          {for $i = 5; $i > 0; $i--}
          <input class="b-star-rating__input" id="star-rating-{$i}" type="radio" name="ratec" value="{$i}" {if $i == $old_ratec} checked{/if}>
          <label class="b-star-rating__ico fa fa-star-o fa-lg" for="star-rating-{$i}" title="{$i} {tlang('out of 5 stars')}"></label>
          {/for}
        </div>
      </div>
    </div>
  </div>
  <!-- END Rating field -->

  <!-- Review field textarea BEGIN -->
  <div class="g-form-m__field">
    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Review')}</div>
    <div class="g-form-m__field-section">
      <textarea class="g-form-m__field-area" name="comment_text" rows="5" placeholder="{tlang('Your review')}" required>{$old_text}</textarea>
    </div>
  </div>
  <!-- END Review field textarea -->

  <!-- Captcha field BEGIN -->
  {if $use_captcha}
  <div class="g-form-m__field">
    <div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Security code')}</div>
    <div class="g-form-m__field-section">
      <div class="g-form-m__field-captcha g-clearfix">
        <input class="g-form-m__field-input" type="text" name="captcha" required>
        <p class="g-form-m__field-desc">{tlang('Type the characters you see in this image.')}</p>
        <div class="g-form-m__field-captcha-image">{$cap_image}</div>
      </div>
    </div>
  </div>
  {/if}
  <!-- END Captcha field -->

  <!-- Submit button BEGIN -->
  <div class="g-form-m__buttons">
    <input class="g-form-m__button-submit g-btn_l" type="submit" value="{tlang('Send')}">
  </div>
  <!-- END Submit button -->

  {form_csrf()}
</form>
