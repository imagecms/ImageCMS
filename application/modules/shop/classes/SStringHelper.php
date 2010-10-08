<?php

class SStringHelper {

    // Перенос длинных строк
    public static function wordwrap($str, $len=50, $break=" ", $cut=false)
    { 
        if(empty($str)) return ""; 
        
        $pattern=""; 
        if(!$cut) 
            $pattern="/(\S{".$len."})/u"; 
        else 
            $pattern="/(.{".$len."})/u"; 
        
        return preg_replace($pattern, "\${1}".$break, $str); 
    }

    // Отменки слов
    // Пример:
    // $word[0] - 1 комментария
    // $word[1] - 2 комментария
    // $word[2] - 5 комментариев
    public static function Pluralize($count=0, array $words=array())
    {
        if (empty($words)) $words=array(' ',' ',' ');

       	$numeric = (int) abs($count);
		if ( $numeric % 100 == 1 || ($numeric % 100 > 20) && ( $numeric % 10 == 1 ) ) return $words[0];
		if ( $numeric % 100 == 2 || ($numeric % 100 > 20) && ( $numeric % 10 == 2 ) ) return $words[1];
		if ( $numeric % 100 == 3 || ($numeric % 100 > 20) && ( $numeric % 10 == 3 ) ) return $words[1];
		if ( $numeric % 100 == 4 || ($numeric % 100 > 20) && ( $numeric % 10 == 4 ) ) return $words[1];
		return $words[2];
    }
}
