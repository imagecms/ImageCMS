<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class email_model extends CI_Model {

    private $db_name;

    function __construct() {
        parent::__construct();
        $this->db_name = "emails";
    }

    public function fromArray($data = array()) {
        if (count($data) > 0) {
            if (isset($data['name']) && ($data['name'] != '')) {
                if (count($this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `name`='" . $data['name'] . "' AND `locale`='" . $data['locale'] . "' ")->row_array()) > 0) {
                    $this->db->query("UPDATE `" . $this->db_name . "` SET `template`='" . $data['text'] . "',`settings`='" . serialize($data['settings']) . "', `description`='" . $data['description'] . "' WHERE `name`='" . $data['name'] . "' AND `locale`='" . $data['locale'] . "'");
                } else {
                    $this->db->query("INSERT INTO `" . $this->db_name . "` (`name`, `template`, `settings`, `locale`, `description`) VALUES ('" . $data['name'] . "', '" . $data['text'] . "', '" . serialize($data['settings']) . "', '" . $data['locale'] . "', '" . $data['description'] . "')");
                }
            }
        }
    }

    public function getMailArray($name, $locale) {
        return $this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `locale`='" . $locale . "' AND `name`='" . $name . "' LIMIT 1")->row_array();
    }

    public function getList($locale) {
        if ($locale != '' && $locale != null)
            return $this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `locale`='" . $locale . "'")->result_array();
        else
            return false;
    }

    public function delete($names = array()) {
        if (count($names) > 0) {
            $arr = "(";
            foreach ($names as $key => $name) {
                $arr .= "'" . $name . "'";
                if (count($names) - 1 > $key)
                    $arr .= " , ";
                else
                    $arr .= ")";
            }
            $query = "DELETE FROM `" . $this->db_name . "` WHERE `name` IN " . $arr;
            $this->db->query($query);
        }else {
            return false;
        }
    }

    public function install_samples() {
        $query = "CREATE TABLE IF NOT EXISTS `emails` (
          `name` varchar(50) CHARACTER SET utf8 NOT NULL,
          `template` text CHARACTER SET utf8 NOT NULL,
          `settings` text CHARACTER SET utf8 NOT NULL,
          `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
          `description` text CHARACTER SET utf8 NOT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

        $this->db->query($query);

        $emails = array(
            array('name' => 'wishListMail', 'text' => 'Шановний %userName%. Ви створили наступний список побажань %wishKey%<br>Створений: %wishDateCreated%  ', 'settings' => 'a:4:{s:5:"theme";s:29:"Список побажань";s:4:"from";s:43:"Адміністрація магазину";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";a:3:{i:0;s:10:"%userName%";i:1;s:9:"%wishKey%";i:2;s:17:"%wishDateCreated%";}}', 'locale' => 'ua', 'description' => 'Лист про створений список побажань  '),
            array('name' => 'wishListMail', 'text' => '<h2> Уважаемый %userName%.</h2> Вы создали следующий список желаний %wishKey%<div>Ссылка на просмотр списка желаний -&nbsp;&nbsp; %wishLink% <br>Создан %wishDateCreated%   %orderId% </div>  ', 'settings' => 'a:5:{s:5:"theme";s:14:"Вишлист";s:4:"from";s:43:"Администрация магазина";s:9:"from_mail";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Письмо о создании списка желаний.  '),
            array('name' => 'noticeOfAppearance', 'text' => 'Шаблон письма  ', 'settings' => 'a:5:{s:5:"theme";s:46:"Уведомлениен о появлении";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Шаблон письма об уведомлении о появлении  '),
            array('name' => 'callBackNotification', 'text' => 'Callback notification  ', 'settings' => 'a:5:{s:5:"theme";s:8:"Callback";s:4:"from";s:24:"Пользователь";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Шаблон письма для callback  '),
            array('name' => 'toAdminOrderNotification', 'text' => 'Шаблон письма для администратора о совершении заказа  ', 'settings' => 'a:5:{s:5:"theme";s:59:"Уведомление о совершении заказа";s:4:"from";s:34:"Админ панель сайта";s:10:"from_email";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Шаблон письма для администратора о совершении заказа    '),
            array('name' => 'toUserOrderNotification', 'text' => 'Здравствуйте, %userName%.<br><br>Мы благодарны Вам за то, что совершили заказ в нашем магазине "ImageCMS Shop"<br><br>Вы указали следующие контактные данные:<br><br>Email адрес: %userEmail%<br><br>Номер телефона: %userPhone%<br><br>Адрес доставки: %userDeliver%<br><br>Менеджеры нашего магазина вскоре свяжутся с Вами и помогут с оформлением и оплатой товара.<br><br>Также, Вы можете всегда посмотреть за статусом Вашего заказа, перейдя по ссылке:&nbsp; %orderLink%.<br><br>Спасибо за ваш заказ, искренне Ваши, сотрудники ImageCMS Shop.<br><br>При возникновении любых вопросов, обращайтесь за телефонами:<br><br>+7 (095) 222-33-22 +38 (098) 222-33-22  ', 'settings' => 'a:5:{s:5:"theme";s:80:"Уведомление покупателя о совершении заказа";s:4:"from";b:0;s:9:"from_mail";s:21:"noreply@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Уведомление покупателя о совершении заказа  '),
            array('name' => 'toUserChangeOrderStatusNotification', 'text' => 'Уведомление пользователя о смене статуса заказа    ', 'settings' => 'a:5:{s:5:"theme";s:89:"Уведомление пользователя о смене статуса заказа";s:4:"from";s:37:"Администрация сайта";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Уведомление пользователя о смене статуса заказа    '),
            array('name' => 'afterOrderUserRegistration', 'text' => 'Письмо о регистрации на сатйе после совершения заказа  ', 'settings' => 'a:5:{s:5:"theme";s:38:"Регистрация на сайте";s:4:"from";s:43:"Администрация магазина";s:10:"from_email";s:19:"admin@localhost.loc";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Письмо о регистрации на сатйе после совершения заказа    '),
            array('name' => 'forgotPassword', 'text' => 'Здравствуйте!<br><br>На сайте %webSiteName% создан запрос на восстановление пароля для Вашего аккаунта.<br><br>Для завершения процедуры восстановления пароля перейдите по ссылке %resetPasswordUri%<br><br>Ваш новый пароль для входа: %password%<br><br>Если это письмо попало к Вам по ошибке просто проигнорируйте его.<br><br>При возникновении любых вопросов, обращайтесь по телефонам:<br><br>(012)&nbsp; 345-67-89 , (012)&nbsp; 345-67-89<br><br>---<br><br>С уважением,<br><br>сотрудники службы продаж %webSiteName%  ', 'settings' => 'a:5:{s:5:"theme";s:41:"Восстановление пароля";s:4:"from";s:37:"Администрация сайта";s:9:"from_mail";s:0:"";s:9:"variables";b:0;s:9:"mail_type";s:4:"html";}', 'locale' => 'ru', 'description' => 'Шаблон письма о восстановлении пароля  ')
        );
        foreach ($emails as $email)
            $this->db->query("INSERT INTO `" . $this->db_name . "` (`name`, `template`, `settings`, `locale`, `description`) VALUES ('" . $email['name'] . "', '" . $email['text'] . "', '" . $email['settings'] . "', '" . $email['locale'] . "', '" . $email['description'] . "')");
    }

    public function deinstall() {
        $query = "DROP TABLE `" . $this->db_name . "`";
    }

}

?>
