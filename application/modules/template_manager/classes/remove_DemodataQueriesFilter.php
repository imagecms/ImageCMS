<?php

namespace template_manager\classes;

use PHPSQLParser\PHPSQLParser;

/**
 *
 * Attention! This class has the test, so if you will make some changes in
 * behavior here don't forget to bring test up do date
 *
 * @author kolia
 */
class DemodataQueriesFilter
{

    /**
     *
     * @var array
     */
    protected $allowedDemodataTables = [];

    /**
     * DemodataQueriesFilter constructor.
     * @param array|null $allowedDemoDataTables
     */
    public function __construct(array $allowedDemoDataTables = null) {
        if (null === $allowedDemoDataTables) {
            $this->allowedDemodataTables = \CI::$APP->load
                ->module('template_manager')
                ->config
                ->item('allowedDemodataTables');
        } else {
            $this->allowedDemodataTables = $allowedDemoDataTables;
        }
    }

    /**
     * @param string $query
     * @return bool
     */
    public function verifyQuery($query) {
        if (!$query) {
            return false;
        }

        $query = strtolower($query);

        $constantTablePart = '[\`]{0,1}__table__([\`\s]+|$)/';

        $patterns = [
                     '/drop([\s]+temporary){0,1}[\s]+table([\s]+if[\s]+exists){0,1}[\s]+', // http://dev.mysql.com/doc/refman/5.6/en/drop-table.html
                     '/create([\s]+temporary){0,1}[\s]+table([\s]+if[\s]+not[\s]+exists){0,1}[\s]+', // http://dev.mysql.com/doc/refman/5.1/en/create-table.html
                     '/update([\s]+low_priority){0,1}([\s]+ignore){0,1}[\s]+table[\s]+', //https://dev.mysql.com/doc/refman/5.0/en/update.html
                     '/delete([\s]+low_priority){0,1}([\s]+quick){0,1}([\s]+ignore){0,1}[\s]+from[\s]+', //https://dev.mysql.com/doc/refman/5.0/en/delete.html
                     '/truncate([\s]+table){0,1}[\s]+', //https://dev.mysql.com/doc/refman/5.0/en/truncate-table.html
                     '/insert([\s]+low_priority){0,1}([\s]+delayed){0,1}([\s]+high_priority){0,1}([\s]+ignore){0,1}([\s]+into){0,1}[\s]+', // http://dev.mysql.com/doc/refman/5.6/en/insert.html
                    ];

        foreach ($this->allowedDemodataTables as $table) {
            // compile patterns for current table
            $tablePatterns = [];
            $countPatterns = count($patterns);
            for ($i = 0; $i < $countPatterns; $i++) {
                $tablePatterns[$i] = str_replace('__table__', strtolower($table), $patterns[$i] . $constantTablePart);
            }
            $countTablePatterns = count($tablePatterns);
            for ($j = 0; $j < $countTablePatterns; $j++) {
                if (preg_match($tablePatterns[$j], $query) != 0) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param string $query
     * @return bool|string
     */
    public function filterSettings($query) {
        if (1 !== preg_match('/insert\s+into\s+\`settings\`/i', trim($query))) {
            return false;
        }

        $parser = new PHPSQLParser();
        $parsed = $parser->parse($query);

        $columnsCount = count($parsed['INSERT'][2]['sub_tree']);
        $valuesCount = count($parsed['VALUES'][0]['data']);
        if ($columnsCount === $valuesCount) {

            foreach ($parsed['INSERT'][2]['sub_tree'] as $key => $one) {

                if (1 === strpos($one['base_expr'], 'siteinfo')) {
                    $settingsPosition = $key;
                    $siteInfoData = $parsed['VALUES'][0]['data'][$settingsPosition]['base_expr'];
                    $query = "UPDATE `settings` SET `siteinfo`=$siteInfoData";
                    return $query;
                }
            }
        }
        return false;
    }

}