<?php
if (validation_errors() OR $other_errors) {
    echo '<b>Обнаружены следующие ошибки:</b><br/><div class="errors_list">' . validation_errors('', '<br/>') . $other_errors . '</div>';
}
?>

<h2>Параметры сайта</h2>
<form action="" method="post">
    <?php echo form_csrf(); ?>
    <p>
    <div class="form_text">Название сайта</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['site_title'] ?>" name="site_title"  autocomplete="off">
    </div>
    <div class="form_overflow"></div>
    
    <div class="form_text">Язык административной части</div>
    <div class="form_input">
        <select name="lang_sel">
            <option value="russian_lang" >Русский</option>
            <option value="english_lang" >English (beta)</option>
        </select>
    </div>
    <div class="form_overflow"></div>


    <div class="form_text">Устанавливать примеры продуктов</div>
    <div class="form_input">
        <input type="checkbox" class="checkbox" name="product_samples" checked="checked" value = "on">
    </div>
    <div class="form_overflow"></div>


    <h2>Подключение к базе данных</h2>
    <div class="form_text"></div>
    <div class="form_input">
        <span style="background-color:#EF8080;padding:4px;color:#000000;border:2px solid #C82F2F;">
            <b>Внимание:</b> все данные в указанной Вами базе будут уничтожены.
        </span>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Хост</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php if ($_POST['db_host'] != '') echo $_POST['db_host']; else echo 'localhost'; ?>" name="db_host" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Имя пользователя</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_user'] ?>" name="db_user" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Пароль</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_pass'] ?>" name="db_pass" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Имя базы</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_name'] ?>" name="db_name" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <h2>Данные администратора</h2>
    <div class="form_text">Логин</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['admin_login'] ?>" name="admin_login" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">Пароль</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['admin_pass'] ?>" name="admin_pass" autocomplete="off">
    </div>
    <div class="form_overflow"></div>


    <div class="form_text">E-Mail</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['admin_mail'] ?>" name="admin_mail" autocomplete="off">
    </div>
    <div class="form_overflow"></div>
</p>

<p align="left">
    <br/>
    <input type="submit" class="button_130" value="Далее">

</p>
</form>

<div class="lite">Все поля обязательны к заполнению.</div>
<br/>
