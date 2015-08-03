<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DependenceBase
 */
abstract class DependenceBase {

    /**
     * Error messages array
     * @var array
     */
    protected $messages = array();

    /**
     * SimpleXMLElement dependence node
     * @var \SimpleXMLElement 
     */
    protected $node;

    /**
     * Dependence type
     * @var string 
     */
    public $type;

    /**
     * Dependence name
     * @var string 
     */
    public $name;

    /**
     * Dependence relation
     * @var string 
     */
    public $relation;

    /**
     * @param \SimpleXMLElement $node
     */
    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $attrs = $this->node->attributes();
        $this->name = (string) $attrs['name'];
        $this->type = (string) $attrs['type'];
        $this->relation = (string) $attrs['relation'];
    }

    /**
     * Verify dependence relations
     * @return bool 
     */
    abstract public function verify();

    /**
     * Get error messages
     * @return array
     */
    public function getMessages() {
        return count($this->messages) > 0 ? $this->messages : FALSE;
    }

}

