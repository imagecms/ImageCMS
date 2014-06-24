<?php
if ($other_errors) {
    echo '<b>' . lang('Was founded following errors', 'install') . ':</b><br/><div class="alert alert-error errors_list">' . $other_errors . '</div>';
}
?>

<h2><?php echo lang('Site Settings', 'install') ?></h2>
<form action="" method="post">
    <?php echo form_csrf(); ?>
    <p>
    <div class="form_text"><?php echo lang('Site title', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['site_title'] ?>" name="site_title"  autocomplete="off">
        <span style="color: red;">*</span>
        <?php if ($this->form_validation->error('site_title')) echo '<div class="alert alert-error errors_list">' . $this->form_validation->error('site_title') . '</div>' ?>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Language of the administrative part', 'install') ?></div>
    <div class="form_input">
        <select name="lang_sel">
            <option value="ru_RU" ><?php echo lang('Russian', 'install') ?></option>
            <option value="en_US" ><?php echo lang('English', 'install') ?></option>
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Install demo data', 'install') ?></div>
    <div class="form_input">
        <input type="checkbox" class="checkbox" name="product_samples" checked="checked" value = "on">
    </div>
    <div class="form_overflow"></div>


    <h2><?php echo lang('Database connection', 'install') ?></h2>
    <div class="form_text"></div>
    <div class="form_input">
        <div class="alert">
            <b><?php echo lang('Attention', 'install') ?>:</b><?php echo lang('All the data in this database will be destroyed', 'install') ?>.
        </div>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Host', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php
        if ($_POST['db_host'] != '')
            echo $_POST['db_host'];
        else
            echo 'localhost';
        ?>" name="db_host" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('User name', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_user'] ?>" name="db_user" autocomplete="off">
        <span style="color: red;">*</span>
<?php if ($this->form_validation->error('db_user')) echo '<div class="alert alert-error errors_list">' . $this->form_validation->error('db_user') . '</div>' ?>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Password', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_pass'] ?>" name="db_pass" autocomplete="off">
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Database name', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['db_name'] ?>" name="db_name" autocomplete="off">
        <span style="color: red;">*</span>
<?php if ($this->form_validation->error('db_name')) echo '<div class="alert alert-error errors_list">' . $this->form_validation->error('db_name') . '</div>' ?>
    </div>
    <div class="form_overflow"></div>

    <h2><?php echo lang('Administrator name', 'install') ?></h2>

    <div class="form_text">E-Mail</div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['admin_mail'] ?>" name="admin_mail" autocomplete="off">
        <span style="color: red;">*</span>
<?php if ($this->form_validation->error('admin_mail')) echo '<div class="alert alert-error errors_list">' . $this->form_validation->error('admin_mail') . '</div>' ?>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"><?php echo lang('Password', 'install') ?></div>
    <div class="form_input">
        <input type="text" class="textbox" value="<?php echo $_POST['admin_pass'] ?>" name="admin_pass" autocomplete="off">
        <span style="color: red;">*</span>
<?php if ($this->form_validation->error('admin_pass')) echo '<div class="alert alert-error errors_list">' . $this->form_validation->error('admin_pass') . '</div>' ?>
    </div>
    <div class="form_overflow"></div>

</p>

<p align="left">
    <br/>
    <button class="btn btn-success" type="submit" class="button_130"><i class="icon-ok icon-white"></i> <?php echo lang('Next', 'install') ?> </button>

</p>
</form>

<br/>
