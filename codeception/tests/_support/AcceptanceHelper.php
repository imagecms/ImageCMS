<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
//class AcceptanceHelper extends \AcceptanceTester
class AcceptanceHelper extends \Codeception\Module
{
    /**Counting specified tags on page 
     * 
     * @param type $I           controller
     * @param type $tags        "tag1 tag2"   
     * @param type $position    first element position
     * @return type
     */
    public function grabTagCount ($I,$tags,$position='0'){
        $tag = explode(" ",$tags);
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
    
    /**Counting elements with specified class
     * 
     * @param type $I       controller
     * @param type $class   class wich you want to count
     * @return type         count
     */
    public function grabClassCount ($I,$class){
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByClassName(\"$class\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $count = $I->grabValueFrom('#length');
        return $count;
    }
    
    /**Scrolling  page to specified element
     * 
     * @param \AcceptanceTester $I controller
     * @param type $CSSelement CSS selector
     */
    public function scrollToElement(\AcceptanceTester $I,$CSSelement) {
        $script = "$('html,body').animate({scrollTop:$('$CSSelement').offset().top});";
        $I->executeJS($script);
    }
    
    
    /**
     * Grab text from all elements which select with JQUERY
     * and write them to array
     * 
     * @todo normalize 
     * 
     * @param \AcceptanceTester $I
     * @param type $JQuerySelector
     * @return array
     */
    public function grabTextFromAllElements(\AcceptanceTester $I,$JQuerySelector) {
        $delimiter = 'DELIMIT';
        $script =<<<HERE
        el = $('$JQuerySelector');
        rl = el.length;
        tex = '';
        for(i=0;i<rl;i++){
        tex+='$delimiter'+el.eq(i).text();
        };
        $('<p id='GRABTEXTFROMALL'></p>').text(tex).appendTo('body');
HERE;
        $I->executeJS($script);
        $text = $I->grabTextFrom('p#GRABTEXTFROMALL');
        $text = explode($delimiter, $text);
        return $text;
     
    }
}