<?php
$gettext_pattern = array(
  "~\{\"([^\"]+)\"\|_([^\}]*)\}~",  // search for smarty modifier: {"Text to be localized"|_}
  "~\{t\}([^\{]+)\{/t\}~",
  "~lang\(\'(.*?)\'\)~",
  "~lang\(\"(.*?)\"\)~" // search for smarty modifier: {t}Text to be localized{/t}
);

define('_DAT', '/var/www/image.loc/_temp.php');

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
    $found_in[] = $file_on_disk;
  }
}

$mod = array();
foreach ( $gettext_pattern as $pattern) {
  preg_match_all($pattern, $text, $regs);
  $mod = array_merge($mod, $regs[1]);
}

if ($mod) {
  foreach($mod AS $value) {
    $result .= '_("'.$value.'");'."\n";
  }
  $result = "<?php\n/*\n".implode("\n",$found_in)."*/\n\n".$result."\n?>";

  _log($result);
  exec('xgettext --force-po -o "'.$p[1].'" '.$p[2].' '.$p[3].' '._DAT);
//  unlink(_DAT);
}
?>