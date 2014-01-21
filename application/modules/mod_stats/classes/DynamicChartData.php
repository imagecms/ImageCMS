<?php

/**
 * 
 */
class DynamicChartData {

    public function processData($data) {

        $newStructure1 = array();
        foreach ($data as $row) {
            $date = $row['date'];
            unset($row['date']);
            foreach ($row as $field => $value) {
                $newStructure1[$field][] = array(
                    'x' => $date,
                    'y' => $value
                );
            }
        }

        $newStructure2 = array();
        foreach ($newStructure1 as $key => $values) {
            $newStructure2[] = array(
                'key' => $key,
                'values' => $values,
            );
        }

        return $newStructure2;
    }

}
