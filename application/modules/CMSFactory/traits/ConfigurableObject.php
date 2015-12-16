<?php

namespace CMSFactory\traits;

/**
 *
 */
trait ConfigurableObject
{

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = []) {
        $this->configure($config);
        $this->init();
    }

    /**
     *
     * @param array $config
     * @return \servers_sync\classes\ContentSync
     * @throws \InvalidArgumentException
     */
    protected function configure(array $config) {
        foreach ($config as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException('Configuration error: uknown config item "' . $key . '"');
            }
            $this->$key = $value;
        }
    }

    /**
     * This will be called in constructor
     */
    abstract protected function init();

}