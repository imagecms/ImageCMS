<?php

namespace CMSFactory\MetaManipulator;

/**
 * Class MetaStorage
 * @package CMSFactory\MetaManipulator
 */
class MetaStorage
{

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $descriptionTemplate;

    /**
     * @var string
     */
    private $h1Template;

    /**
     * @var string
     */
    private $keywords;

    /**
     * @var string
     */
    private $keywordsTemplate;

    /**
     * @var string
     */
    private $paginationTemplate;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $titleTemplate;

    /**
     * @var string
     */
    private $seoTextTemplate;

    /**
     * @var array
     */
    private $vars = [];

    /**
     * @return string
     */
    public function getDescription() {

        return $this->description;
    }

    /**
     * @return string
     */
    public function getDescriptionTemplate() {

        return $this->descriptionTemplate;
    }

    /**
     * @param string $descriptionTemplate
     */
    public function setDescriptionTemplate($descriptionTemplate) {

        $this->setVars($this->parseVars($descriptionTemplate));
        $this->descriptionTemplate = $descriptionTemplate;
    }

    /**
     * @return string
     */
    public function getSeoTextTemplate() {
        return $this->seoTextTemplate;
    }

    /**
     * @param $seoTextTemplate
     */
    public function setSeoTextTemplate($seoTextTemplate) {

        $this->setVars($this->parseVars($seoTextTemplate));
        $this->seoTextTemplate = $seoTextTemplate;
    }

    /**
     * @param string $template
     * @return array
     */
    protected function parseVars($template = '') {

        $keys = [];

        preg_match_all('/%(\w*)(\[.\])?(\[.\])?%/', $template, $matches);

        foreach ($matches[1] as $key => $match) {
            $keys[] = $matches[1][$key] . $matches[2][$key] . $matches[3][$key];
        }

        return $keys;
    }

    /**
     * @return string
     */
    public function getH1Template() {

        return $this->h1Template;
    }

    /**
     * @param string $h1Template
     */
    public function setH1Template($h1Template) {

        $this->setVars($this->parseVars($h1Template));
        $this->h1Template = $h1Template;
    }

    /**
     * @return string
     */
    public function getKeywords() {

        return $this->keywords;
    }

    /**
     * @return string
     */
    public function getKeywordsTemplate() {

        return $this->keywordsTemplate;
    }

    /**
     * @param string $keywordsTemplate
     */
    public function setKeywordsTemplate($keywordsTemplate) {

        $this->setVars($this->parseVars($keywordsTemplate));
        $this->keywordsTemplate = $keywordsTemplate;
    }

    /**
     * @return string
     */
    public function getPaginationTemplate() {

        return $this->paginationTemplate;
    }

    /**
     * @param string $paginationTemplate
     */
    public function setPaginationTemplate($paginationTemplate) {

        $this->setVars($this->parseVars($paginationTemplate));
        $this->paginationTemplate = $paginationTemplate;
    }

    /**
     * @return string
     */
    public function getTitle() {

        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitleTemplate() {

        return $this->titleTemplate;
    }

    /**
     * @param string $titleTemplate
     */
    public function setTitleTemplate($titleTemplate) {

        $this->setVars($this->parseVars($titleTemplate));
        $this->titleTemplate = $titleTemplate;
    }

    /**
     * @return array
     */
    public function getVars() {

        return $this->vars;
    }

    /**
     * @param array $vars
     */
    public function setVars($vars) {

        $this->vars = array_merge($vars, $this->getVars());
    }

}