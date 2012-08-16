
<style type="text/css">
form#{$form.url} {literal}{
	width:80%;
	margin:10px auto;
}
.xinput {
	margin:20px;
	clear:both;
	width:100%;
	overflow:hidden;
}
.xinput label {
	display:block;
	float:left;
	width:20%;
	text-align:right;
	margin-right:20px;
}
.xinput input {
	float:left;
	width:30%;
	padding:2px 4px;
}
.submit {
	width:70px;
	margin:10px auto;
}
.submit input {
	padding:5px 10px;
}
.result {
	font-size:12px;
	color:red;
}
.result.good {
	color:#090;
}
</style>
{/literal}
<h2>{$form.title}</h2>
{$form.desc}
<form action="{site_url('xform/show')}/{$form.url}" method="post" enctype="multipart/form-data" id="{$form.url}">
{if $result}
	<div class="result{if $result==$form.seccuss} good{/if}">{$result}</div>
{/if}
{foreach $fields as $field}
{if $field.type=='text'}
<div class="xinput">
	<label for="{$field.name}">{if $field.require==1}*{/if}{$field.label}</label>
	<input type="text" name="{$field.name}" id="{$field.name}" value="{$field.value}"{if $field.maxlength >0} maxlength="{$field.maxlength}"{/if} {$field.operation}{if $field.disabled==1} disabled="disabled"{/if}  />
    {if $field.desc}<p class="desc">{$field.desc}</p>{/if}
</div>
{elseif $field.type=='textarea'}
<div class="xinput">
	<label for="{$field.name}">{if $field.require==1}*{/if}{$field.label}</label>
	<textarea name="{$field.name}" id="{$field.name}"{$field.operation}{if $field.disabled==1} disabled="disabled"{/if}>{$field.value}</textarea>
    {if $field.desc}<p class="desc">{$field.desc}</p>{/if}
</div>
{elseif $field.type=='checkbox'}
<div class="xinput">
	<label for="{$field.name}">{if $field.require==1}*{/if}{$field.label}</label>
	<input type="checkbox" name="{$field.name}" id="{$field.name}" value="{$field.value}"{$field.operation}{if $field.disabled==1} disabled="disabled"{/if} />
    {if $field.desc}<p class="desc">{$field.desc}</p>{/if}
</div>
{elseif $field.type=='select'}
<div class="xinput">
	<label for="{$field.name}">{if $field.require==1}*{/if}{$field.label}</label>
	<select name="{$field.name}" id="{$field.name}" {$field.operation}{if $field.disabled==1}disabled="disabled"{/if}>
    {$value = explode("\n",$field.value)}
    {foreach $value as $val}
    	<option value="{$val}">{$val}</option>
    {/foreach}
    </select>
    {if $field.desc}<p class="desc">{$field.desc}</p>{/if}
</div>
{elseif $field.type=='radio'}

{elseif $field.type=='file'}

{/if}
{/foreach}
{if count($fields)>0}
<div class="input" style="display:none;">
	<input type="text" name="captcha" value="" />
</div>
<div class="submit">
	{form_csrf()}
  	<input type="submit" value="Отправить" />
</div>
{/if}
</form>