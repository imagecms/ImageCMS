<?php

$pubPath = realpath(__DIR__ . '/../../../../..');
require_once $pubPath . '/application/modules/exchange/classes/VariantCharacteristics.php';

use exchange\classes\VariantCharacteristics;

/**
 * /var/www/image.loc/tests$ php codecept.phar run unit exchange/classes/VariantCharacteristicsTest.php
 */
class VariantCharacteristicsTest extends \PHPUnit_Framework_TestCase {

    protected $storageFilePath = '/tmp/1c_characteristics.json';
    protected $testedObject;

    protected function setUp() {
        if (file_exists($this->storageFilePath)) {
            unlink($this->storageFilePath);
        }
    }

    protected function tearDown() {
        
    }

    public function testAddCharacteristic() {

        $testedObject = new VariantCharacteristics($this->storageFilePath);

        $testedObject->addCharacteristic('Color', 'Black');
        $testedObject->addCharacteristic('Color', 'Red');
        $testedObject->addCharacteristic('Color', 'Purple');

        $testedObject->addCharacteristic('Weight', 'Lightweight');
        $testedObject->addCharacteristic('Weight', 'Heavy');

        $testedObject->saveCharacteristics();

        $this->assertEquals('Color', $testedObject->getCharacteristicName('Black'));
        $this->assertEquals('Color', $testedObject->getCharacteristicName('Red'));
        $this->assertEquals('Weight', $testedObject->getCharacteristicName('Heavy'));
        $this->assertEquals(null, $testedObject->getCharacteristicName('Qrtyus'));
    }

    public function testDeletionCharacteristics() {
        $testedObject = new VariantCharacteristics($this->storageFilePath);

        $testedObject->addCharacteristic('Color', 'Black');
        $testedObject->addCharacteristic('Color', 'Red');
        $testedObject->addCharacteristic('Color', 'Purple');

        $testedObject->addCharacteristic('Weight', 'Lightweight');
        $testedObject->addCharacteristic('Weight', 'Heavy');

        $testedObject->saveCharacteristics();

        $testedObject->deleteCharacteristic('Color');

        $this->assertEquals(null, $testedObject->getCharacteristicName('Black'));
        $this->assertEquals(null, $testedObject->getCharacteristicName('Purple'));
        $this->assertEquals('Weight', $testedObject->getCharacteristicName('Heavy'));

        $testedObject->saveCharacteristics('Color');

        $this->assertEquals(null, $testedObject->getCharacteristicName('Black'));
        $this->assertEquals(null, $testedObject->getCharacteristicName('Purple'));
        $this->assertEquals('Weight', $testedObject->getCharacteristicName('Heavy'));

        $testedObject2 = new VariantCharacteristics($this->storageFilePath);
        $this->assertEquals(null, $testedObject2->getCharacteristicName('Black'));
        $this->assertEquals(null, $testedObject2->getCharacteristicName('Purple'));
        $this->assertEquals('Weight', $testedObject2->getCharacteristicName('Heavy'));
    }

    public function testParseVariantName() {
        $testedObject = new VariantCharacteristics($this->storageFilePath);

        $testedObject->addCharacteristic('Color', 'Black');
        $testedObject->addCharacteristic('Color', 'Red');
        $testedObject->addCharacteristic('Color', 'Purple');

        $testedObject->addCharacteristic('Weight', 'Lightweight');
        $testedObject->addCharacteristic('Weight', 'Heavy');

        $testedObject->addCharacteristic('Size', 'Small');
        $testedObject->addCharacteristic('Size', 'LARGE');


        $someVariantName = 'IPhone 7S Heavy LARGE SomeUknown Property';
        $variantCharacteristics = $testedObject->getVariantCharacteristics($someVariantName);
        
        $this->assertTrue(in_array('LARGE', $variantCharacteristics));
        $this->assertTrue(in_array('Heavy', $variantCharacteristics));
        
        $this->assertTrue(key_exists('Weight', $variantCharacteristics));
        $this->assertTrue(key_exists('Size', $variantCharacteristics));
    }

}
