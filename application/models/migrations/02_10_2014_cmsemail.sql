-- добавлення змінної "коментар" до зміни статусу в модулі cmsemail
UPDATE 
    `mod_email_paterns_i18n` 
SET `variables` = 'a:5:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email Пользователя";s:11:"$orderLink$";s:28:"Ссылка на заказ";s:8:"$status$";s:25:"статус заказа";s:9:"$comment$";s:38:"Комментарий к заказу";}' 
WHERE 
    id = 2 AND 
    locale = 'ru'
LIMIT 1;