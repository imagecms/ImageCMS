<?php
use Gettext\Translation;
use translator\classes\LangReplacer;

/**
 * 1. Знайти всі ланги і замінити ключ на переклад на англ мову якщо існує переклад
 * 2. Знайти всі ланги і замінити ключ на переклад на англ мову
 *
 *
 * 3. Переклади після сортування зробити шоб завжди сортувалось однаково
 *
 */
class test extends MY_Controller
{

    public function run() {

        //        dump(LangReplacer::getAllModules());

        //        LangReplacer::replaceModuleLangStrings($module);

        //                LangReplacer::replaceMainLangStrings();
        //               LangReplacer::findCyrillicKeys('main');

    }

}