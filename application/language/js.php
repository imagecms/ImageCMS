<?php
$gettext_pattern = array(
  "~\{\"([^\"]+)\"\|_([^\}]*)\}~",  // search for smarty modifier: {"Text to be localized"|_}
  "~lang\(\'(.*?)\'~",
  "~lang\(\"(.*?)\"~" 
);

define('_DAT', '_js.php');

function _log($s) {
	$f=fopen(_DAT,'wb');
	fwrite($f, $s);
	fclose($f);
}

$p = $_SERVER['argv'];

$text = '';
$result = '';
$found_in = array();

for($k=3; $k<count($p); $k++) {
  $file = $p[$k];
  foreach(glob(str_replace('_','?',$file)) AS $_ => $file_on_disk) {
    $text .= file_get_contents($file_on_disk);
    $found_in[] = realpath($file_on_disk);
  }
}
$domain = array();
preg_match('/modules\/([a-zA-Z]+)/', $found_in[1], $domain);

$mod = array();
foreach ( $gettext_pattern as $pattern) {
  preg_match_all($pattern, $text, $regs);
  $mod = array_merge($mod, $regs[1]);
}

if ($mod) {
//    foreach ($domain as $dom){
//        $result .= $dom;
//    }
  foreach($mod AS $value) {
    $result .= "lang['" . md5($value). "']" . " = " . ' ". '  . "lang('".$value."', '" . $domain[1] . "')". '."' . ";"."\n";
  }
  $result = "<?php\n/*\n".implode("\n",$found_in)."*/\n\n". 'echo "' . ' <script> lang = {}; ' . $result. ' </script>'. '"; ' ."\n?>";

  _log($result);
  exec('xgettext --force-po -o "'.$p[1].'" '.$p[2].' '.$p[3].' '._DAT);
  //unlink(_DAT);
}
?>
