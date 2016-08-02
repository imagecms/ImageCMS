<?php
namespace template_manager\classes;

class DemoDataSQLFilter implements \IteratorAggregate
{

    /**
     * @var array
     */
    private $queries = [];

    private $patterns = ['insert' => '/insert([\s]+low_priority){0,1}([\s]+delayed){0,1}([\s]+high_priority){0,1}([\s]+ignore){0,1}([\s]+into){0,1}\s+(\S+)\s+/i'];

    /**
     * @var string
     */
    private $currentTable;

    /**
     * @var array
     */
    private $allowTables = [];

    public function __construct(array $allowTables) {
        $this->allowTables = $allowTables;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function filter($query) {

        if (preg_match($this->patterns['insert'], $query, $matches)) {
            $table = trim($matches[6], '`');
            $insertStatement = $matches[0];
            $query = trim(strstr($query, $insertStatement));

            if (in_array($table, $this->allowTables)) {
                $this->currentTable = $table;
                return $query;
            }
        }
    }

    public function parse($string) {
        $string_query = rtrim($string, "\n;");
        $this->queries = explode(";\n", str_replace(";\r\n", ";\n", $string_query));
    }

    /**
     * @return \Generator
     */
    public function getIterator() {
        foreach ($this->queries as $query) {

            if (($query = $this->filter($query)) !== null) {
                yield $query;
            }
        }
    }

    /**
     * @return string
     */
    public function getCurrentTable() {
        return $this->currentTable;
    }
}