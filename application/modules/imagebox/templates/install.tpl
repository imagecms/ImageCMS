<div style="padding:10px;">
<h2>Установка</h2>

<ul>

<li>Скопируйте содержимое архива в директорию <b>./application/modules/</b>. Через панель управления установите модуль.</li>

<li>Создайте директории <b>./uploads/imagebox</b>, <b>./uploads/imagebox/thumbs</b> и установите им права на запись(chmod 0777)</li>

<li>Откройте файл <b>./application/libraries/lib_editor.php</b> и найдите там следующий код(примерно 62 строка)

<pre>$code =  "
	
{htmlspecialchars('<!-- TinyMCE -->')}</pre>

измените его на следующий код:
<pre>$code =  "
&lt;script type=\"text/javascript\" src=\"".media_url('application/modules/imagebox/templates/js/imagebox.js')."\"&gt;&lt;/script&gt;
{htmlspecialchars('<!-- TinyMCE -->')}</pre>
</li>

<li>
Далее найдите строку "<b>relative_urls : false,</b>" и после неё вставте следующий код <br />
<pre>{literal}      setup : function(ed) {
                    ed.addButton('imagebox', {
                    title : 'Imagebox',
                    image : '/application/modules/imagebox/templates/images/button.png',
                    onclick : function() {
                                show_main_window();
                            }
                    });
                },{/literal}</pre>
</li>


<li>В нужной вам теме пропишите имя кнопки imagebox.
<br/>Например:  <b>theme_advanced_buttons1 : "bold,italic,underline,strikethrough, imagebox</b>
</li>

<li>Откройте файл <b>./templates/имя_шашего_шаблона/main.tpl</b> и между тегами &lt;head&gt;...&lt;/head&gt;  вставте следующий код
<pre>{literal}{{/literal}imagebox_headers(){literal}}{/literal}</pre>
</li>

</ul>

</div>
