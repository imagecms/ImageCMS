<?php

/**
 * 
 */
class ChartDataRemap {

    public function remapFor2Axises($data) {

        $newStructure1 = array();
        foreach ($data as $row) {
            $date = $row['unix_date'];
            unset($row['unix_date']);
            unset($row['date']);
            foreach ($row as $field => $value) {
                $newStructure1[$field][] = array((float) ($date * 1000), (int) $value);
            }
        }
        return $newStructure1;
    }

}
