<?php

namespace translator\classes;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Replacer - class for replacing russian origin strings to english
 */
class Replacer
{

    /**
     * FileOperator instance
     * @var Replacer object
     */
    private static $instance;

    /**
     * PoFileManager object
     * @var PoFileManager
     */
    private static $PO_FILE_MANAGER;

    private function __construct() {
        self::$PO_FILE_MANAGER = new PoFileManager();
    }

    /**
     * Get Replacer instance
     * @return Replacer
     */
    public static function getInstatce() {
        if (null === self::$instance) {
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }

    /**
     * Prepare po file translation
     * @param array $po_file - po file array
     * @param bool|string $isOrigin - is po file locale is origins locale
     * @return array
     */
    private function prepareFile($po_file, $isOrigin = TRUE) {
        if ($po_file['po_array']) {
            $counter = 0;
            foreach ($po_file['po_array'] as $origin => $lang) {
                $lang['translation'] = $lang['translation'] ? $lang['translation'] : YandexTranslate::getInstatce()->translate('ru', $origin, 'en');
                $lang['translation'] = preg_match('/[а-яА-Я]/', $lang['translation']) ? YandexTranslate::getInstatce()->translate('ru', $lang['translation'], 'en') : $lang['translation'];

                if (isset($po_file['po_array'][$lang['translation']])) {
                    $sufix = '_' . $counter;
                    $new_origin = $lang['translation'] . $sufix;

                    $po_file['po_array'][$new_origin] = $lang;
                    $po_file['po_array'][$new_origin]['translation'] = $isOrigin ? $lang['translation'] : $origin;
                    unset($po_file['po_array'][$origin]);
                } else {
                    $po_file['po_array'][$lang['translation']] = $lang;
                    $po_file['po_array'][$lang['translation']]['translation'] = $isOrigin ? $lang['translation'] : $origin;
                    unset($po_file['po_array'][$origin]);
                }
                $counter++;
            }
        }

        $po_file = array_merge($po_file, $po_file['po_array']);
        unset($po_file['po_array']);
        $po_file['settings'] = self::$PO_FILE_MANAGER->prepareUpdateSettings($po_file['settings']);

        return $po_file;
    }

    /**
     * Change langs origins in files
     * @param string $origin - old lang key
     * @param string $new_origin - new lang key
     * @param string $template_name - template name
     */
    private function filesChange($origin, $new_origin, $template_name) {
        $dir = './templates/' . $template_name;
        $baseDir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach ($baseDir as $file) {
            if ($file->isFile()) {
                if (in_array($file->getExtension(), FilesParser::$ALLOW_EXTENSIONS) && !strstr($file->getBasename(), 'jsLangs')) {
                    $content = file_get_contents($file->getPathname());
                    $quote = strstr($new_origin, '"') ? "'" : '"';

                    $content = str_replace("'" . $origin . "'", $quote . $new_origin . $quote, $content);
                    $content = str_replace('"' . $origin . '"', $quote . $new_origin . $quote, $content);
                    file_put_contents($file->getPathname(), $content);
                }
            }
        }
    }

    /**
     * Replaes po file lags
     * @param array $po_file - po file data in array
     * @param string $template_name - template name
     */
    public function replaceFilesLangs($po_file, $template_name) {
        $counter = 0;
        foreach ($po_file['po_array'] as $origin => $lang) {
            $lang['translation'] = preg_match('/[а-яА-Я]/', $lang['translation']) ? YandexTranslate::getInstatce()->translate('ru', $lang['translation'], 'en') : $lang['translation'];
            if (isset($po_file['po_array'][$lang['translation']])) {
                $sufix = '_' . $counter;
                $new_origin = $lang['translation'] . $sufix;

                $this->filesChange($origin, $new_origin, $template_name);
            } else {
                $this->filesChange($origin, $lang['translation'], $template_name);
            }
            $counter++;
        }
    }

    /**
     * Run replace process
     * @param string $template_name - template name
     */
    public function run($template_name) {
        $this->makeBackup($template_name);

        $po_file = self::$PO_FILE_MANAGER->toArray($template_name, 'templates', 'en_US');

        $this->replaceFilesLangs($po_file, $template_name);
        $en_po_file = $this->prepareFile($po_file, TRUE);

        $po_file = self::$PO_FILE_MANAGER->toArray($template_name, 'templates', 'en_US');
        $ru_po_file = $this->prepareFile($po_file, FALSE);

        self::$PO_FILE_MANAGER->save($template_name, 'templates', 'ru_RU', $ru_po_file);
        self::$PO_FILE_MANAGER->save($template_name, 'templates', 'en_US', $en_po_file);
    }

    /**
     * Make template backup before raplacing
     * @param string $template_name
     */
    public function makeBackup($template_name) {
        $this->copyFolder($template_name);
    }

    /**
     * Copy directory
     * @param string $template_name - template name
     * @param string $source - source file to source folder
     * @param string $dest - destignation folder path
     */
    private function copyFolder($template_name, $source = '', $dest = '') {
        $source = $source ? $source : './templates/' . $template_name;

        if (!$dest) {
            $dest = $source . '_backup_' . time();
            echo 'Template backup folder - ' . $dest . '<br>';
            echo '<a target="_blanck" href="/translator/restoreTemplate/?source=' . $template_name . '&backup=' . $dest . '">Restore template from backup</a>';
        } else {
            echo 'Success restore.';
        }

        mkdir($dest, 0777);
        foreach ($iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $item) {
            if ($item->isDir()) {
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0777);
                chmod($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0777);
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
                chmod($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0777);
            }
        }
        chmod($dest, 0777);
    }

    /**
     * Remove directory
     * @param string $dirPath - directory path
     */
    private function removeDir($dirPath) {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
            $path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
        }
        rmdir($dirPath);
    }

    /**
     * Restore template
     * @param string $template_name - template name
     * @param string $backup - backup path
     */
    public function restoreTemplate($template_name, $backup) {
        $template_path = './templates/' . $template_name;
        $this->removeDir($template_path);
        if (!$backup) {
            $backups = glob($template_path . '_backup_*');
            sort($backups);
            $backup = array_pop($backups);
        }
        $this->copyFolder($template_name, $backup, $template_path);
    }

    /**
     * Replace langs with another domain value
     * @param string $fileData - text needed to replace langs
     * @param string $domain - domain name(lang second parameter)
     * @return false|string
     */
    public function replaceFileLangsWithDomain($fileData, $domain) {
        if (!$fileData) {
            return FALSE;
        }

        $regExpr = [
                    "/(?<!\w)t?langf?\([']{1}(?!\")(.*?)[']{1}.*?[)]{1}/"   => "lang('$1', '$domain')",
                    '/(?<!\w)t?langf?\([\"]{1}(?!\')(.*?)[\"]{1}.*?[)]{1}/' => "lang(\"$1\", '$domain')",
                   ];

        foreach ($regExpr as $pattern => $replacement) {
            $fileData = preg_replace($pattern, $replacement, $fileData);
        }

        return $fileData;
    }

}