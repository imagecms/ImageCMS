<?php

class InitTest {

    
    public static function VerifyLogInOrLogOutUkr($I) {
        $I->amOnPage('/');
        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
        $I->comment($Atrib);
        $I->wait(2);
        if($Atrib==0){
            $I->click(LocUaPage::$CabinetButton);
            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
            $I->click(LocUaPage::$ProfileButton);
            $I->click(LocUaPage::$ExitButton);
            $I->seeInCurrentUrl('/');            
        } 
    }

    public static function VerifyLogInOrLogOutRus($I) {
        $I->amOnPage('/');
        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
        $I->comment($Atrib);
        $I->wait(2);
        if($Atrib==0){
            $I->click(LocRusPage::$CabinetButton);
            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
            $I->click(LocRusPage::$ProfileButton);
            $I->click(LocRusPage::$ExitButton);
            $I->seeInCurrentUrl('/');            
        } 
    }
    
    public function VerifyLogInOrLogOutUsa($I) {
        $I->amOnPage('/');
        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
        $I->comment($Atrib);
        $I->wait(2);
        if($Atrib==0){
            $I->click(LocEngPage::$CabinetButton);
            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
            $I->click(LocEngPage::$ProfileButton);
            $I->click(LocEngPage::$ExitButton);
            $I->seeInCurrentUrl('/');            
        } 
    }
}
