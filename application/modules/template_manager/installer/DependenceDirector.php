<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DependenceDirector
 */
class DependenceDirector {

    /**
     * Status of dependences verify
     * @var boolean
     */
    private $status = TRUE;

    /**
     * SilmpleXmlElement dependence node
     * @var \SilmpleXmlElement
     */
    private $dependicies;

    /**
     * Error messages array
     * @var array
     */
    private $messages = array();

    public function __construct(\SimpleXMLElement $dependicies) {
        $this->dependicies = $dependicies;
    }

    /**
     * Verify dependences
     * @return type
     */
    public function verify($installDemodata = FALSE) {
        foreach ($this->dependicies as $key => $node) {
            $attributes = $node->attributes();
            $handlerClass = "template_manager\\installer\\" . ucfirst($attributes['entityName']) . 'Dependence';
            include_once __DIR__ . DIRECTORY_SEPARATOR . $handlerClass . EXT;
            
            $dependence = new $handlerClass($node);

            $status = $dependence->verify($installDemodata);
            if ($status == FALSE) {
                $this->status = FALSE;
            }

            // gathering messages
            if (FALSE !== $msgs = $dependence->getMessages()) {
                foreach ($msgs as $message) {
                    $this->messages[] = array(
                        'text' => $message,
                        'relation' => $dependence->relation,
                        'name' => $dependence->name,
                        'type' => $dependence->type,
                    );
                }
            } elseif ($status == FALSE) {
                $this->messages[] = array(
                    'relation' => $dependence->relation,
                    'name' => $dependence->name,
                    'type' => $dependence->type,
                );
            }
        }
        return $this->status;
    }

    /**
     * Get error messages
     * @return type
     */
    public function getMessages() {
        return $this->messages;
    }

}

?>
