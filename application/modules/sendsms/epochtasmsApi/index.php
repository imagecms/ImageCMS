<?php

include 'config.php';
include 'Addressbook.php';
include 'Exceptions.php';
include 'Account.php';
include 'Stat.php';

$Gateway = new APISMS($sms_key_private, $sms_key_public, 'http://atompark.com/api/sms/');
$Addressbook = new Addressbook($Gateway);
$Exceptions = new Exceptions($Gateway);
$Account = new Account($Gateway);
$Stat = new Stat($Gateway);

//Первым делом, зарегистрируем имя отправителя, если собираемся рассылать СМС в том числе в Украину
//Если вы собираетесь отправлять смс исключительно в Россию - регистрировать имя отправителя нет необходимости
$res = $Account->registerSender('testName', 'ua');

//Проверяем успешность операции
if (isset($res["result"]["error"])) {
    die("Ошибка: " . $res["result"]["code"]);
}

//Создаем адресную книгу
$res = $Addressbook->addAddressBook('Test book');

//Проверяем успешность операции
if (isset($res["result"]["error"])) {
    die("Ошибка: " . $res["result"]["code"]);
} else {
//Получаем ИД книги
    $addrbook_id = $res["result"]["addressbook_id"];
}

//Добавляем несколько телефонов для рассылки
$res = $Addressbook->addPhoneToAddressBook($addrbook_id, '79010000001', 'Валерий;Маринец;');
if (isset($res["result"]["error"])) {
    echo ("Ошибка: " . $res["result"]["code"] . "<br/>");
}
$res = $Addressbook->addPhoneToAddressBook($addrbook_id, '79010000002', 'Сергей;Вершинин;');
if (isset($res["result"]["error"])) {
    echo ("Ошибка: " . $res["result"]["code"] . "<br/>");
}

//Проверяем баланс счета
$res = $Account->getUserBalance();
if (isset($res["result"]["error"])) {
    echo ("Ошибка: " . $res["result"]["code"] . "<br/>");
} else {
    echo ("Баланс: " . $res["result"]["result"]["balance_currency"] . " " . $res["result"]["result"]["currency"]);
    $balance = $res["result"]["balance_currency"];
}

//Проверим, хватает ли денег на запланированную рассылку
$res = $Stat->checkCampaignPrice("testName", "Тестируем отправку смс сообщения через ePochta SMS", $addrbook_id);
if (isset($res["result"]["error"])) {
    die("Ошибка: " . $res["result"]["code"] . "<br/>");
} else {
    $cost = $res["result"]["price"];
}

if ($balance > $cost) {
//А теперь по созданной адресной книге отправим рассылку
    $res = $Stat->createCampaign("testName", "Тестируем отправку смс сообщения через ePochta SMS", $addrbook_id, "", 0, 0, 0, "");
    if (isset($res["result"]["error"])) {
        echo ("Ошибка: " . $res["result"]["code"] . "<br/>");
    } else {
        $campaign_id = $res["result"]["id"];
    }

//Теперь можно получить данные о доставке. Понятно, что в реальности необходимо будет немного подождать для обновления статусов, сохранив $campaign_id и выполнив запрос позже.
    $res = $Stat->getCampaignDeliveryStats($campaign_id);
//если запрос выполнить сразу, то мы получим JSON примерно следующего содержания
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
} else {
//недостаточно денег на рассылку
}
?>

