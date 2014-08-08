<?php

namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
//class AcceptanceHelper extends \AcceptanceTester
class AcceptanceHelper extends \Codeception\Module {
    /*     * Counting specified tags on page 
     * 
     * @param   AcceptanceTester  $I           controller
     * @param   string            $tags        "tag1 tag2"   
     * @param   int               $position    first element position
     * @return  null
     */

    public function grabTagCount($I, $tags, $position = '0') {
        $tag = explode(" ", $tags);
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByTagName(\"$tag[0]\")[$position].getElementsByTagName(\"$tag[1]\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $lines = $I->grabValueFrom('#length');
        return $lines;
    }

    public function assertEquals($expected, $actual, $message = '') {
        parent::assertEquals($expected, $actual, $message);
    }

    public function fail($message) {
        parent::fail($message);
    }

    /*     * Counting elements with specified class
     * 
     * @param   AcceptanceTester    $I       controller
     * @param   string              $class   class wich you want to count
     * @return  type                Amount
     */

    public function grabClassCount($I, $class) {
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByClassName(\"$class\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $count = $I->grabValueFrom('#length');
        return $count;
    }

    /*     * Scrolling  page to specified element
     * 
     * @param \AcceptanceTester $I          controller
     * @param string            $CSSelement CSS selector
     */

    public function scrollToElement($I, $CSSelement) {
        $script = "$('html,body').animate({scrollTop:$('$CSSelement').offset().top});";
        $I->executeJS($script);
    }

    /**
     * Grab text from all elements selected with JQUERY
     * and write them to array
     * 
     * @todo normalize 
     * 
     * @param   AcceptanceTester    $I                  controller
     * @param   string              $JQuerySelector     JQueryCssSelector     
     * @return  array               Texts from elements
     * 
     * div.body_category div.row-category div.share_alt a.pjax
     */
    public function grabTextFromAllElements($I, $JQuerySelector) {
        $delimiter = '--D_E_L--';
        $script = <<<HERE
            element = $('$JQuerySelector');
            var tex = [];
            for(i=0;i<element.length;i++){
                tex += '$delimiter'+element.eq(i).text();
            };
            $('<p id="GRABTEXTFROMALL"></p>').text(tex).appendTo('body');
HERE;
        $I->executeJS($script);
        $text = $I->grabTextFrom('#GRABTEXTFROMALL');
        $text = explode($delimiter, $text);
        array_shift($text);
        return $text;
    }

    /**
     * click all finded buttons together
     * can click n times if pased $clicktimes
     * can set the wait between clicks
     * 
     * @param AcceptanceTester  $I              controller
     * @param string            $JQeryElements  JQ_CSS_Slecector  
     * @param int               $clickTimes     times
     * @param int               $deelay         pause between clicks
     * @return null null
     * 
     * .btn.expandButton
     */
    public function clickAllElements($I, $JQeryElements, $clickTimes = 1, $deelay = 3) {
        $script = <<<SCRIPT
          $('$JQeryElements:visible').click();
SCRIPT;
        for ($j = 0; $j < $clickTimes;  ++$j) {
            $I->executeJS($script);
            $I->wait($deelay);
        }
    }

    /**
     * Grab amount of el-ts selected by JQuery
     * 
     * @param   AcceptanceTester    $I
     * @param   string              $JQerySelector
     * @return  string              Amount of elements
     */
    public function grabCCSAmount($I, $JQerySelector) {
        $script = "$('<p id=uniqueidunique></p>').text($('$JQerySelector').length).appendTo('body')";
        $I->executeJS($script);
        $amount = $I->grabTextFrom("#uniqueidunique");
        return $amount;
    }

     /**
      * @param type $I
      * @param type $type            type of alert success|error
      * @param type $message         message of alert
      * @param type $times           one time = 1 milliseconds && 1000 microseconds
      */
    public function exactlySeeAlert($I,$type = 'success', $message = null,$times = '30') {
        //define element
        if ($type == 'success') {
            $element = '.alert.in.fade.alert-success';
        } elseif ($type == 'error') {
            $element = '.alert.in.fade.alert-error';
        } else {
            $I->fail('unknown type of message, pass "success" or "error" string');
        }
        for ($j = 1; $j <= $times; ++$j) {
            $I->comment("$j");
            try {
                $see = $I->see($message, $element);
                if (!isset($see)) {
                    $see = true;
                    break;
                }
            } catch (\Exception $exc) {
            usleep(100000);
            }
        }
        if ($see) {
            $I->comment("I see message");
        } else {
            $I->fail("Sory I couldn't see alert message");
        }
    }

}
