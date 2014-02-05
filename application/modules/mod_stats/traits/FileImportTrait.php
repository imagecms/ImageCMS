<?php

trait FileImportTrait {

    /**
     * Include file (or all recursively files in dir) 
     * The starting directory is the directory where the class is (witch using trait)
     * @param string $filePath
     */
    public function import($filePath) {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if ($ext != 'php' && $ext != "")
            return;

        $filePath = str_replace('.php', '', $filePath);
        $reflection = new ReflectionClass($this);
        $workingDir = pathinfo($reflection->getFileName(), PATHINFO_DIRNAME);
        $filePath = $workingDir . DIRECTORY_SEPARATOR . str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $filePath);
        if (strpos($filePath, '*') === FALSE) {
            include_once $filePath . EXT;
        } else {
            $filesOfDir = get_filenames(str_replace('*', '', $filePath), TRUE);
            foreach ($filesOfDir as $file) {
                if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) == 'php') {
                    include_once str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $file);                    
                }
            }
        }
    }

}