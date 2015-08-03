<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DependenceDirector
 */
class DemodataDirector {

    /**
     * Status of dependences verify
     * @var boolean
     */
    private $status = TRUE;

    /**
     * SilmpleXmlElement dependence node
     * @var \SilmpleXmlElement
     */
    private $demodata;

    /**
     * Error messages array
     * @var array
     */
    private $messages = array();

    public function __construct(\SimpleXMLElement $demodata) {
        $this->demodata = $demodata;
    }

    /**
     * Verify dependences
     * @return type
     */
    public function install() {
        foreach ($this->demodata->children() as $demodataName => $node) {
            $handlerClass = "Demodata" . ucfirst($demodataName);
            include_once __DIR__ . DIRECTORY_SEPARATOR . $handlerClass . EXT;
            
            $handlerClass = 'template_manager\\installer\\' . $handlerClass;
            $demodata = new $handlerClass($node);

            $status = $demodata->install();
            if ($status == FALSE) {
                $this->status = FALSE;
            }
//
            // gathering messages
            if (FALSE !== $msgs = $demodata->getMessages()) {
                foreach ($msgs as $message) {
                    $this->messages[] = array(
                        'text' => $message,
                    );
                }
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
