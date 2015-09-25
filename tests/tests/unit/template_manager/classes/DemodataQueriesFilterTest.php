<?php

define('PUBPATH', realpath(__DIR__ . '/../../../../..'));
require_once PUBPATH . '/application/modules/template_manager/classes/DemodataQueriesFilter.php';

use template_manager\classes\DemodataQueriesFilter;

/**
 * Run:
 * $project/tests$ php codecept.phar run unit template_manager/classes/DemodataQueriesFilterTest.php
 */
class DemodataQueriesFilterTest extends \PHPUnit_Framework_TestCase {

    protected $allowedDemodataTables;

    protected function setUp() {
        $this->allowedDemodataTables = [
            'content',
            'menus',
            'menu_translate',
            'shop_product_variants_i18n',
        ];
    }

    protected function tearDown() {
        
    }

    public function dropQueriesProvider() {
        return [
            ['drop temporary table if exists `content` asdfasdf ', true],
            ['  drop table if exists content', true],
            ['
               drop TABLE `content` ', true],
            [' drop table `menu_translate` ', true],
            [' drop table if exists `shop_product_variants_i18n`', true],
            ['    drop temporary temporary table if exists `shop_product_variants_i18n`', false],
            ['drop table `some_table1`', false],
            ['drop temporary table if exists `some_table2`', false],
        ];
    }

    /**
     * @dataProvider dropQueriesProvider
     */
    public function testDrop($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

    public function createQueriesProvider() {
        return [
            ['
                create temporary table if not exists `content` asdfasdf ', true],
            ['adf  create table if not exists `content` ', true],
            ['    create table `menu_translate` asdfaf((((', true],
            [' create temporary table `menu_translate` asdfaf((((', true],
            ['create temporary temporary table `menu_translate` ...', false],
            ['---   create temporary table `users` ...', false],
            ['  create temporary table users ...', false],
            ['create temporary table if not exists users ...', false],
            ['       create temporary table if not exists menus', true],
        ];
    }

    /**
     * @dataProvider createQueriesProvider
     */
    public function testCreate($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

    public function updateQueriesProvider() {
        return [
            ['some---  update LOW_PRIORITY IGNORE table `content` set ... ', true],
            ['  update LOW_PRIORITY table `content` set ... ', true],
            [' update LOW_PRIORITY table `users` set ... ', false],
            [' update table `shop_product_variants_i18n` set ... ', true],
            ['update LOW_PRIORITY table `some_table_that_inst_int_allowed` set ... ', false],
            ['update adasdf table `shop_product_variants_i18n` set ... ', false],
            ['       update adasdf LOW_PRIORITY table `shop_product_variants_i18n` set ... ', false],
            ['update LOW_PRIORITY table `menus` set ... ', true],
            ['update LOW_PRIORITY table menu_translate set ... ', true],
            ['update table `menus` set ... ', true],
        ];
    }

    /**
     * @dataProvider updateQueriesProvider
     */
    public function testUpdate($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

    public function deleteQueriesProvider() {
        return [
            ['   delete low_priority IGNORE from `content`', true],
            [' delete low_priority IGNORE from content', true],
            ['delete low_priority IGNORE from users', false],
            ['asdfa delete IGNORE from users ', false],
            ['delete from menus asdfa ', true],
            ['delete from `menus`', true],
            ['   delete from menus111 ', false],
            [' 111 delete IGNORE from users', false],
            ['delete IGNORE from menu_translate', true],
            ['  delete low_priority from menu_translate', true],
            ['delete low_priority from `menu_translate`', true],
        ];
    }

    /**
     * @dataProvider updateQueriesProvider
     */
    public function testDelete($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

    public function truncateQueriesProvider() {
        return [
            ['  truncate `content`', true],
            ['truncate table `content`', true],
            ['  truncate table menus', true],
            ['truncate content', true],
            ['truncate menu_translate', true],
            ['truncate menu_translate123', false],
            ['truncate 1231 menu_translate123', false],
            ['truncate 1231 menu_translate123 ', false],
            ['truncate shop_product_variants_i18n', true],
            ['truncate table `shop_product_variants_i18n`', true],
        ];
    }

    /**
     * @dataProvider truncateQueriesProvider
     */
    public function testTruncate($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

    public function insertQueriesProvider() {
        return [
            ['ad  insert into `content`  asdf', true],
            [' insert high_priority into `content`', true],
            ['   insert high_priority into `shop_product_variants_i18n`', true],
            ['   insert high_priority into menu_translate', true],
            [' insert into menu_translate', true],
        ];
    }

    /**
     * @dataProvider insertQueriesProvider
     */
    public function insertTruncate($query, $expected) {
        $demodataQueriesFilter = new DemodataQueriesFilter($this->allowedDemodataTables);
        $this->assertEquals($demodataQueriesFilter->verifyQuery($query), $expected);
    }

}
