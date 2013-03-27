<?php
$itr = new RecursiveIteratorIterator( new RecursiveDirectoryIterator('./'), RecursiveIteratorIterator::CHILD_FIRST );
$f = fopen('_out.php', 'w');
fwrite($f, '');
fclose($f);
$f = fopen('_out.php', 'a');
myFn($itr, $f);
fclose($f);
unset( $itr );

function myFn($iter, $f) {
    foreach ($iter as $item) {
        if (!$item->isDir()) {
            if (strpos($item->getFileName(), '.tpl')) {
                $contents = file_get_contents($item->getPath() .'/'. $item->getFileName());
                $parsed = str_replace(array('{', '}'),array(' <?php ', ' ?> '), $contents);
                fwrite($f, $parsed);
            }
        }
    }
}