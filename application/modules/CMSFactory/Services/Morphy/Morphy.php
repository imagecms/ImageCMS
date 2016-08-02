<?php namespace CMSFactory\Services\Morphy;

use phpMorphy;

/**
 * Service: morphy
 * Class Morphy
 * @package CMSFactory\Services\Morphy
 */
class Morphy
{

    /**
     * @var array
     */
    private $cases = [
                      1 => 'ИМ',//Именительный
                      2 => 'РД',//Родительный
                      3 => 'ДТ',//Дательный
                      4 => 'ВН',//Винительный
                      5 => 'ТВ',//Творительный
                      6 => 'ПР',//Предложный
                     ];

    const PLURAL = 'МН';
    const SINGULAR = 'ЕД';

    /**
     * method processing meta data
     * @var phpMorphy
     */
    private $phpMorphy;

    private $wordsCache = [];

    /**
     * Morphy constructor
     * @param phpMorphy $phpMorphy
     */
    public function __construct(phpMorphy $phpMorphy) {
        $this->phpMorphy = $phpMorphy;
    }

    /**
     * @param string $string
     * @param int $case
     * @return mixed|string
     */
    public function morphy($string, $case = 1) {

        if (array_key_exists($case, $this->cases)) {

            $case = $this->cases[$case];

            $arrayString = explode(' ', $string);
            $arrayString = array_map(
                function ($word) use ($case) {
                    return $this->morphyWord($word, $case);
                },
                $arrayString
            );

            $string = implode(' ', $arrayString);
        }
        return $string;

    }

    /**
     * @param string $word
     * @param string $case
     * @return mixed|string
     */
    private function morphyWord($word, $case) {
        $word = trim($word);
        $key = $word . '_' . $case;

        if (!isset($this->wordsCache[$key])) {

            $initialString = $word;
            $request = [$case];

            $stringCase = $this->getStrCase($word);

            $word = mb_strtoupper($word, $this->phpMorphy->getEncoding());

            $res = $this->phpMorphy->getGramInfo($word)[0][0]['grammems'];

            $converted = false;
            if (is_array($res)) {
                $form = in_array(self::PLURAL, $res) ? self::PLURAL : self::SINGULAR;
                array_push($request, $form);

                $cast = $this->phpMorphy->castFormByGramInfo($word, null, $request, true);

                if (is_array($cast)) {
                    $word = array_shift($cast);
                    $converted = true;
                }
            }

            if ($converted && $word != '') {
                $word = mb_convert_case($word, $stringCase);
            } else {
                $word = $initialString;
            }

        } else {
            $word = $this->wordsCache[$word];
        }

        return $word;
    }

    /**
     * @param string $string
     * @return int
     */
    private function getStrCase($string) {
        if (mb_strtoupper($string) == $string) {
            return MB_CASE_UPPER;
        } elseif (mb_strtolower($string) == $string) {
            return MB_CASE_LOWER;
        }
        return MB_CASE_TITLE;
    }
}