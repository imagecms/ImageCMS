<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sendsms Module Admin
 * @property Addressbook $Addressbook
 * @property Exceptions $Exceptions 
 * @property Account $Account
 * @property Stat $Stat
 * @property Sendsms_model $sendsms_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        include 'epochtasmsApi/config.php';
        include 'epochtasmsApi/Addressbook.php';
        include 'epochtasmsApi/Exceptions.php';
        include 'epochtasmsApi/Account.php';
        include 'epochtasmsApi/Stat.php';

        $this->load->model('sendsms_model');

        $this->settings = $this->sendsms_model->getApiSettings();

        $Gateway = new APISMS($this->settings['sms_key_private'], $this->settings['sms_key_public'], 'http://atompark.com/api/sms/');
        $this->Addressbook = new Addressbook($Gateway);
        $this->Exceptions = new Exceptions($Gateway);
        $this->Account = new Account($Gateway);
        $this->Stat = new Stat($Gateway);
    }

    public function saveSettings($locale) {
        $locale = $locale == null ? MY_Controller::getCurrentLocale() : $locale;

        $this->sendsms_model->setApiSettings($this->input->post());
        showMessage(lang('Saved', 'sendsms'));
    }

    public function save($locale) {
        $locale = $locale == null ? MY_Controller::getCurrentLocale() : $locale;
        $this->sendsms_model->setSettings($this->input->post(), $locale);
        showMessage(lang('Saved', 'sendsms'));
    }

    public function trans($locale) {
        $locale = $locale == null ? MY_Controller::getCurrentLocale() : $locale;

        $account = $this->Account->getUserBalance();
        if (!$account['error']) {
            $balance = $account['result']['balance_currency'] . ' ' . $account['result']['currency'];
        } else {
            $balance = $account['error'];
        }
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('template', $this->sendsms_model->getTemplates($locale))
                ->setData('settings', $this->settings)
                ->setData('balance', $balance)
                ->registerStyle('style')
                ->setData('languages', ShopCore::$ci->cms_admin->get_langs(true))
                ->renderAdmin('main');
    }

    public function index() {
        $locale = $locale == null ? MY_Controller::getCurrentLocale() : $locale;

        $account = $this->Account->getUserBalance();
        if (!$account['error']) {
            $balance = $account['result']['balance_currency'] . ' ' . $account['result']['currency'];
        } else {
            $balance = $account['error'];
        }
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('template', $this->sendsms_model->getTemplates($locale))
                ->setData('settings', $this->settings)
                ->setData('balance', $balance)
                ->registerStyle('style')
                ->setData('languages', ShopCore::$ci->cms_admin->get_langs(true))
                ->renderAdmin('main');

        exit;

//Первым делом, зарегистрируем имя отправителя, если собираемся рассылать СМС
// в том числе в Украину
//Если вы собираетесь отправлять смс исключительно в Россию - 
//регистрировать имя отправителя нет необходимости
//        $res = $Account->registerSender('testName', 'ua');
////Проверяем успешность операции
//        if (isset($res["result"]["error"])) {
//            die("Ошибка: " . $res["error"]);
//        }
//Создаем адресную книгу
//        $res = $Addressbook->getAddressBook('68006'); //addAddressBook('Test book');
        $res = $Addressbook->addAddressBook('Test book');

//Проверяем успешность операции
        if (isset($res["error"])) {
            die("Ошибка: " . $res["error"]);
        } else {
            echo "addressbook_id " . $res["result"]["addressbook_id"] . "<br>";
//Получаем ИД книги
            $addrbook_id = $res["result"]["addressbook_id"];
        }

//Добавляем несколько телефонов для рассылки                      
        $res = $Addressbook->addPhoneToAddressBook($addrbook_id, '380938681961', 'Валерий;Маринец;');
        if (isset($res["error"])) {
            echo ("Ошибка: " . $res["error"] . "<br>");
        }

//Проверяем баланс счета
        $res = $Account->getUserBalance();
        if (isset($res["result"]["error"])) {
            echo ("Ошибка: " . $res["result"]["code"] . "<br>");
        } else {
            echo ("Баланс: " . $res["result"]["balance_currency"] . " " . $res["result"]["currency"] . '<br>');
            $balance = $res["result"]["balance_currency"];
        }

//Проверим, хватает ли денег на запланированную рассылку
        $res = $Stat->checkCampaignPrice("testName", "Тестируем отправку смс сообщения через ePochta SMS", $addrbook_id);
        var_dump($res);
        if (isset($res["error"])) {
            die("Ошибка: " . $res["error"] . "<br>");
        } else {
            $cost = $res["result"]["price"];
        }

//        if ($balance > $cost) {
//А теперь по созданной адресной книге отправим рассылку
        $res = $Stat->createCampaign("testName", "Тестируем отправку смс сообщения через ePochta SMS", $addrbook_id, "", 0, 0, 0, "");
        var_dump($res);
        if (isset($res["error"])) {
            echo ("Ошибка: " . $res["error"] . "<br>");
        } else {
            $campaign_id = $res["result"]["id"];
        }

//Теперь можно получить данные о доставке. 
//Понятно, что в реальности необходимо будет немного подождать 
//для обновления статусов, 
//сохранив $campaign_id и выполнив запрос позже.
        $res = $Stat->getCampaignDeliveryStats($campaign_id);
        var_dump($res);
//если запрос выполнить сразу, то мы получим JSON 
//примерно следующего содержания
        /*
          {
          "result":{
          "phone":["79010000001","79010000002"],
          "sentdate":["0000-00-00 00:00:00","0000-00-00 00:00:00"],
          "donedate":["0000-00-00 00:00:00","0000-00-00 00:00:00"],
          "status":["0","0"]
          }
          }
          //Что значит, что кампания еще находится в очереди отправки
         */
//        } else {
//            echo 'недостаточно денег на рассылку';
//        }
    }

}
