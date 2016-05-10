<?php

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;


class ImageCMSHooks
{
    /**
     * @param Event $event
     */
    public static function copyTinyMCEFiles(Event $event)
    {

        $fileSystem = new Filesystem();

        $source = './hooks/hookFiles/tinymce';
        $target = './application/third_party/tinymce/tinymce';

        $directoryIterator = new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $event->getIO()->write("Create dir " . $target . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
                $fileSystem->mkdir($target . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                $event->getIO()->write("Copy file to " . $target . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
                $fileSystem->copy($item, $target . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), true);
            }
        }
    }
}