<?php

interface FileImport{

    /**
     * Include file (or all recursively files in dir) 
     * The starting directory is the directory where the class is (witch using trait)
     * @param string $filePath
     */
    public function import($filePath);

}