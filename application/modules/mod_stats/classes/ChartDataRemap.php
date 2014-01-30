<?php

/**
 * Class ChartDataRemap for mod_stats module
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class ChartDataRemap {
    
    /**
     * Remap data for chart with one Y axiss
     * @param array $data
     * @return array
     */
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
    
    /**
     * Remap data for chart with one Y axis
     * @param array $data
     * @return array
     */
    public function remapForOneAxis($data) {
        
        $newStructure1 = array();
        foreach ($data as $row) {
            $date = $row['unix_date'];
            unset($row['unix_date']);
            unset($row['date']);
            foreach ($row as $field => $value) {
                $newStructure1[$field][] = array('x' => (float) ($date * 1000), 'y' => (int) $value);
            }
        }
        
        return $newStructure1;
    }

}
