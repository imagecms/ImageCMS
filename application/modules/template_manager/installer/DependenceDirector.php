<?php

namespace template_manager\installer;

/**
 * 
 *
 * @author 
 */
class DependenceDirector {

    /**
     *
     * @var boolean
     */
    private $status = TRUE;

    /**
     *
     * @var \SilmpleXmlElement
     */
    private $dependicies;

    /**

     * @var array
     */
    private $messages = array();

    public function __construct(\SimpleXMLElement $dependicies) {
        $this->dependicies = $dependicies;
    }

    public function verify() {
        foreach ($this->dependicies as $node) {
            $attributes = $node->attributes();
            $handlerClass = ucfirst($attributes['type']) . 'Dependence';
            include_once __DIR__ . DIRECTORY_SEPARATOR . $handlerClass . EXT;
            $dependence = new $handlerClass($node);

            $status = $dependence->verify();
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

    public function getMessages() {
        return $this->messages;
    }

}

?>
