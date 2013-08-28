<?php

include('application/language/admin/english_lang/admin_lang.php');
include('application/language/admin/english_lang/admin_shop_lang.php');
include('application/language/admin/english_lang/basemodules_lang.php');
include('application/language/admin/english_lang/controller_lang.php');

include('application/language/admin/admin_lang_en.php');
include('application/language/english/calendar_lang.php');
include('application/language/english/date_lang.php');
include('application/language/english/db_lang.php');
include('application/language/english/dx_auth.php');
include('application/language/english/email_lang.php');
include('application/language/english/form_validation_lang.php');
include('application/language/english/ftp_lang.php');
include('application/language/english/imglib_lang.php');
include('application/language/english/main_lang.php');
include('application/language/english/number_lang.php');
include('application/language/english/profiler_lang.php');
include('application/language/english/scaffolding_lang.php');
include('application/language/english/unit_test_lang.php');
include('application/language/english/upload_lang.php');
include('application/language/english/validation_lang.php');


//var_dump($lang);

$itr = new RecursiveIteratorIterator( new RecursiveDirectoryIterator('./'), RecursiveIteratorIterator::CHILD_FIRST );
//$f = fopen('_out.php', 'w');
//fwrite($f, '');
//fclose($f);
//$f = fopen('_out.php', 'a');
//myFn($itr, $f);
myFn($itr, false, $lang);
//fclose($f);
unset( $itr );

function myFn($iter, $f=false, $lang=false) {

    $phrases = 0;
    $files = 0;

    foreach ($iter as $item) {
        if (!$item->isDir()) {
            //if (strpos($item->getFileName(), '.tpl')) {
            if (1) {

                $contents = file_get_contents($item->getPath() .'/'. $item->getFileName());

                $matches = array();

                preg_match_all('/lang\([\'"][\w\d_ ]*[\'"]\)/', $contents, $matches );

                if (count($matches[0]) > 0) {

                    //$f = fopen()
                    $parsed = $contents;
                    foreach ($matches[0] as $matchedText) {

//                        preg_match('/[\'"][\w\d_ ][\'"]/', $matchedText, $subMatch);
                        $str = substr( $matchedText, 6, strlen($matchedText)-8 );

//                        var_dump($subMatch);
//                        if (count($subMatch)) {
                        if (isset($lang[$str])) {
//                            echo '+++'.$matchedText."\n";
//                            echo '+++'.$str."\n\n";
//                            echo isset($lang[$str])?'>>>'.$lang[$str]:'';


                            $newStr = 'lang("'.$lang[$str].'")';

                            $parsed = str_replace($matchedText, $newStr, $parsed);


//                            echo '+++'.$matchedText."\n";
                            //echo '+++'.$newStr."\n\n";
//                            echo isset($lang[$str])?'>>>'.$lang[$str]:'';
                        }
//                        } else
//                            echo '---'.$matchedText."\n\n";
                    }

                    $phrases += count($matches[0]);
                    $files++;
                    //var_dump($matches[0]);

                    $f = fopen($item->getPath() .'/'. $item->getFileName(), 'w');
                    fwrite($f, $parsed);
                    fclose($f);
                    unset($f);
                }



                /*$parsed = str_replace(array('{', '}'),array(' <?php ', ' ?> '), $contents);*/
                //fwrite($f, $parsed);
            }
        }
    }

    echo "phrases: $phrases, files: $files";
}