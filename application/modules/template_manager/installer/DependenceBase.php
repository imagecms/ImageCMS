<?php

namespace template_manager\installer;

/**
 *
 * @author 
 */
abstract class DependenceBase {

    /**
     *
     * @var array
     */
    protected $messages = array();

    /**
     *
     * @var \SimpleXMLElement 
     */
    protected $node;

    /**
     *
     * @var string 
     */
    public $type;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     *
     * @var string 
     */
    public $relation;

    /**
     * 
     * @param \SimpleXMLElement $node
     */
    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $attrs = $this->node->attributes();
        $this->name = $attrs['name'];
        $this->type = $attrs['type'];
        $this->relation = $attrs['relation'];
    }

    /**
     * 
     * @return int status (from DependenceDirector constants) 
     */
    abstract public function verify();

    /**
     * 
     * @return array
     */
    public function getMessages() {
        return count($this->messages) > 0 ? $this->messages : FALSE;
    }

}

