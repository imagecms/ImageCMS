<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/* * *
 * XML library for CodeIgniter
 *
 *    author: Woody Gilk
 * copyright: (c) 2006
 *   license: http://creativecommons.org/licenses/by-sa/2.5/
 *      file: libraries/Xml.php
 */

class Lib_xml
{

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    private $document;

    private $filename;

    /**
     * @param string $file
     * Load an file for parsing
     * @return bool
     */
    public function load($file) {
        $bad = [
                '|//+|',
                '|\.\./|',
               ];
        $good = [
                 '/',
                 '',
                ];
        $file = preg_replace($bad, $good, $file) . '.xml';

        if (!file_exists($file)) {
            return false;
        }

        //$this->document = utf8_encode (file_get_contents($file));
        $this->document = file_get_contents($file);
        $this->filename = $file;

        return true;
    }

    /* END load */

    /**
     *
     * Parse an XML document into an array
     */
    public function parse() {
        $xml = $this->document;
        if ($xml == '') {
            return false;
        }

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        if ($doc->loadXML($xml)) {
            $array = $this->flatten_node($doc);
            if (count($array) > 0) {
                return $array;
            }
        }

        return false;
    }

    /* END parse */

    /**
     * @param DOMDocument $node
     * Helper function to flatten an XML document into an array
     * @return array
     */
    private function flatten_node($node) {

        $array = [];

        foreach ($node->childNodes as $child) {
            if ($child->hasChildNodes()) {
                if ($node->firstChild->nodeName == $node->lastChild->nodeName && $node->childNodes->length > 1) {
                    $array[$child->nodeName][] = $this->flatten_node($child);
                } else {
                    $array[$child->nodeName][] = $this->flatten_node($child);

                    if ($child->hasAttributes()) {
                        $index = count($array[$child->nodeName]) - 1;
                        $attrs = & $array[$child->nodeName][$index]['__attrs'];
                        foreach ($child->attributes as $attribute) {
                            $attrs[$attribute->name] = $attribute->value;
                        }
                    }
                }
            } else {
                return $child->nodeValue;
            }
        }

        return $array;
    }

    /* END node_to_array */
}