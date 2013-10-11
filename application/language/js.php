<?php

//paterns to search langs
$gettext_pattern = array(
//    "~\{\"([^\"]+)\"\|_([^\}]*)\}~", // search for smarty modifier: {"Text to be localized"|_}
    "~lang\(\'(.*?)\'~",
    "~lang\(\"(.*?)\"~"
);

define('_DAT', 'jsLangs.php');

//function for saving php file
function _log($s) {
    $f = fopen(_DAT, 'wb');
    fwrite($f, $s);
    fclose($f);
}

$p = $_SERVER['argv'];

$text = '';
$result = '';
$found_in = array();

//get text to parse from searched files
for ($k = 3; $k < count($p); $k++) {
    $file = $p[$k];
    foreach (glob(str_replace('_', '?', $file)) AS $_ => $file_on_disk) {
        $text .= file_get_contents($file_on_disk);
        $found_in[] = realpath($file_on_disk);
    }
}


$domain = array();
// check domain
// check is it modules
preg_match('/modules\/([a-zA-Z_]+)/', $found_in[0], $domain);
//$domain[2] = $found_in[0];

// check is it admin
if (!$domain) {
    if (strstr($found_in[0], 'admin')) {
        $domain[1] = 'admin';
        $domain[2] = $found_in[0];
    }
}
if (!$domain) {
    preg_match('/templates\/([a-zA-Z_]+)/', $found_in[0], $domain);
}

//search for  langs values
$mod = array();
foreach ($gettext_pattern as $pattern) {
    preg_match_all($pattern, $text, $regs);
    $mod = array_merge($mod, $regs[1]);
}

//save langs for parse and insert into jsLangs.php and jsLangs.tpl files accordingly
if ($mod) {

    //make and write php file to parse it
    foreach ($mod AS $value) {
        $result .= "langs['" . $value . "'] = \". lang('" . $value . "', '" . $domain[1] . "') .\";\n";
    }
    $result = "<?php\n/*\n" . implode("\n", $found_in) . "*/\n\n" . 'echo "' . ' <script> langs = {}; ' . $result . ' </script>' . '"; ' . "\n?>";
    _log($result);

    //make and write tpl file to parse it
    $result = '';
    foreach ($mod AS $value) {
        $result .= "langs['" . $value . "']" . " = " . "\"{lang('" . $value . "', '" . $domain[1] . "')}\"" . ";" . "\n";
    }
    $result = '<script> ' . $result . ' </script>';

    if ($domain[1] == 'admin') {
        $admin_file = str_replace('application/language', 'templates/administrator/inc/jsLangs.tpl', dirname(__FILE__));
        file_put_contents($admin_file, $result);
    } else {
        if (strstr($found_in[0], 'modules')) {
            file_put_contents('assets/jsLangs.tpl', $result);
        }else{
            if(!strstr($found_in[0], 'application')){
                file_put_contents('jsLangs.tpl', $result);                
            }
        }
    }

//parse jsLangs.php file to find langs and save it in .po file
    exec('xgettext --force-po -o "' . $p[1] . '" ' . $p[2] . ' ' . $p[3] . ' ' . _DAT);
//    unlink(_DAT);
}
?>
