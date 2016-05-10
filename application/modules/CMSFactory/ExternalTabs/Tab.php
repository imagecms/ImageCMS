<?php

namespace CMSFactory\ExternalTabs;

use InvalidArgumentException;

/**
 *
 *
 * @author kolia
 */
class Tab
{

    /**
     *
     * placeholders:
     *  - tabId
     *  - tabName
     * @var string
     */
    public $tabButtonTemplate = '<a href="#{tabId}" class="btn btn-small">{tabName}</a>';

    /**
     *
     * placeholders:
     *  - tabId
     *  - tabContent
     * @var string
     */
    public $tabContentTemplate = '<div class="tab-pane" id="{tabId}">{tabContent}</div>';

    /**
     *
     * @var string
     */
    protected $tabName;

    /**
     *
     * @var string
     */
    protected $tabContent;

    /**
     *
     * @var callable
     */
    protected $inputHandlerCallback;

    /**
     *
     * @param string $tabName
     * @param string $tabContent
     * @param callable $inputHandlerCallback
     */
    public function __construct($tabName, $tabContent, $inputHandlerCallback) {
        if (!is_string($tabName) || strlen($tabName) == 0) {
            throw new InvalidArgumentException('Tab button name must be valid string');
        }

        if (!is_string($tabContent) || strlen($tabContent) == 0) {
            throw new InvalidArgumentException('Tab content must be valid string');
        }

        if (!is_callable($inputHandlerCallback)) {
            throw new InvalidArgumentException('Input handler must be valid callable');
        }

        $this->tabName = $tabName;
        $this->tabContent = $tabContent;
        $this->inputHandlerCallback = $inputHandlerCallback;
    }

    /**
     *
     * @return string
     */
    public function renderTabButton() {
        return self::replaceStringPlaceholders(
            $this->tabButtonTemplate,
            [
             'tabId'   => translit_url($this->tabName),
             'tabName' => $this->tabName,
            ]
        );
    }

    /**
     *
     * @return string
     */
    public function renderTabContent() {
        return self::replaceStringPlaceholders(
            $this->tabContentTemplate,
            [
             'tabId'      => translit_url($this->tabName),
             'tabContent' => $this->tabContent,
            ]
        );
    }

    /**
     * Excepts any number of arguments
     * @return mixed
     */
    public function processInput() {
        return call_user_func_array($this->inputHandlerCallback, func_get_args());
    }

    /**
     * Make named placeholders in string
     * @param string $string
     * @param array $data
     * @param array $placeholderWrappers array with 2 elements
     * @return string
     */
    private static function replaceStringPlaceholders($string, array $data, array $placeholderWrappers = ['{', '}']) {

        if (empty($string)) {
            return '';
        }

        if (count($placeholderWrappers) < 2) {
            $placeholderWrappers = [
                                    '{',
                                    '}',
                                   ];
        }

        foreach ($data as $key => $value) {
            $string = str_replace("{$placeholderWrappers[0]}$key{$placeholderWrappers[1]}", $value, $string);
        }

        return $string;
    }

}