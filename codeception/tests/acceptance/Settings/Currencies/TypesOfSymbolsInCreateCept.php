<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField('.//*[@id="mod_name"]/div/input', 'qwweйЫВSDFцук!"№;№%%:??*()_1ЮБ.,7653423');
$I->seeInField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField('.//*[@id="mod_name"]/div/input', '1.7653423');