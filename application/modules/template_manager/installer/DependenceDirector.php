<?php

namespace template_manager\installer;

/**
 * 
 *
 * @author 
 */
class DependenceDirector {

    private $status = TRUE;
    private $dependeciesHandlers = array();
    private $messages = array();

    public function setDependicies(\SilmpleXmlElement $dependicies) {

        foreach ($dependicies as $node) {
            $attributes = $node->attributes();
            $depHandlerClass = ucfirst($attributes['entityName']) . 'Dependence';
            if (!isset($this->dependeciesHandlers[$depHandlerClass])) {
                $this->dependeciesHandlers[$depHandlerClass] = new $depHandlerClass;
            }

            $this->dependeciesHandlers[$depHandlerClass]->setName($attributes['name']);
            $this->dependeciesHandlers[$depHandlerClass]->setType($attributes['type']);
            if ($this->dependeciesHandlers[$depHandlerClass]->verify() == FALSE) {
                $this->status = FALSE;
            }
            $this->messages[] = $this->dependeciesHandlers[$depHandlerClass]->getMessage();
        }

        return $this->status;
    }

    public function getMessages() {
        return $this->messages;
    }

}

?>
