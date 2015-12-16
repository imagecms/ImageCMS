<?php

namespace CMSFactory\MetaManipulator;

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
    private $keywords;

    /**
     * @var string
     */
    private $keywordsTemplate;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $titleTemplate;

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