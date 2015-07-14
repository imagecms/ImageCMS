<div class="g-container">
	<h1 class="b-content__title">
		{tlang('Feedback')}
	</h1>	
	<div class="g-row">
		<div class="g-col-6 g-col-12_from-m">
		<form class="g-form-m g-form-m_main" action="{site_url('feedback')}" method="post">
			{if $message_sent == 1}
			<div class="g-form-m__message g-form-m__message_success">
				{tlang('Your message has been sent')}
			</div>
			{/if}
			{if validation_errors()}
			<div class="g-form-m__message g-form-m__message_error">
				{validation_errors('<p class="g-form-m__message-item">', '</p>')}
			</div>
			{/if}
			<div class="g-form-m__field">
				<div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Name')}</div>
				<div class="g-form-m__field-section">
					<input class="g-form-m__field-input" type="text" name="name" value="{set_value('name')}" required>
					{if form_error('name')}
					<i class="g-form-m__field-error">{form_error('name')}</i>
					{/if}
				</div>
			</div>
			<div class="g-form-m__field">
				<div class="g-form-m__field-title g-form-m__field-title_req">{tlang('E-mail')}</div>
				<div class="g-form-m__field-section">
					<input class="g-form-m__field-input" type="email" name="email" value="{set_value('email')}" required>
					{if form_error('email')}
					<i class="g-form-m__field-error">{form_error('email')}</i>
					{/if}
				</div>
			</div>
 			<div class="g-form-m__field">
	 			<div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Subject')}</div>
				<div class="g-form-m__field-section">
					<input class="g-form-m__field-input" type="text" name="theme" value="{set_value('theme')}" required>
				</div>
				{if form_error('theme')}
				<i class="g-form-m__field-error">{form_error('theme')}</i>
				{/if}
 			</div>
 			<div class="g-form-m__field">
				<div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Message')}</div>
				<div class="g-form-m__field-section">
					<textarea class="g-form-m__field-area" name="message" rows="15" required>{set_value('message')}</textarea>
				</div>
				{if form_error('message')}
				<i class="g-form-m__field-error">{form_error('message')}</i>
				{/if}
 			</div> 
 			{if $captcha_type =='captcha'}
 			<div class="g-form-m__field">
 				<div class="g-form-m__field-title g-form-m__field-title_req">{tlang('Security code')}</div>
 				<div class="g-form-m__field-section">
 					<div class="g-form-m__field-captcha g-clearfix">
 						<input class="g-form-m__field-input" type="text" name="captcha" required>
 						<p class="g-form-m__field-desc">{tlang('Type the characters you see in this image.')}</p>
 						<div class="g-form-m__field-captcha-image">{$cap_image}</div>
 					</div>
 					{if form_error('captcha')}
 					<i class="g-form-m__field-error">{form_error('captcha')}</i>
 					{/if}
 				</div>
			</div>
			{/if}
			<div class="g-form-m__buttons">
				<input class="g-form-m__button-submit g-btn_l" type="submit" value="{tlang('Send')}">
			</div>
			{form_csrf()}
		</form>
		</div>
	</div>
</div>