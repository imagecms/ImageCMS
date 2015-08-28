<?php

/**
 * 
 *
 * @author kolia
 */
abstract class BaseEntity {

    protected $pattern;
    protected $h1;
    protected $metaTitle;
    protected $metaKeywords;
    protected $metaDescription;
    protected $text;

    public function getPattern() {
        return $this->pattern;
    }

    public function getH1() {
        return $this->h1;
    }

    public function getMetaTitle() {
        return $this->metaTitle;
    }

    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    public function getMetaDescription() {
        return $this->metaDescription;
    }

    public function getText() {
        return $this->text;
    }

    public function setPattern($pattern) {
        $this->pattern = $pattern;
    }

    public function setH1($h1) {
        $this->h1 = $h1;
    }

    public function setMetaTitle($metaTitle) {
        $this->metaTitle = $metaTitle;
    }

    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;
    }

    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;
    }

    public function setText($text) {
        $this->text = $text;
    }

}
