<?php

namespace xbanners\src\Entities;

/**
 * @author cray
 */
class BannerEffects implements \ArrayAccess
{

    protected $effects = [
        //@var boolean
                          'autoplay'         => 0,
        //@var int
                          'autoplaySpeed'    => 0,
        //@var boolean
                          'arrows'           => 0,
        //@var boolean
                          'centerMode'       => 0,
        //@var boolean
                          'dots'             => 0,
        //@var boolean
                          'draggable'        => 0,
        //@var boolean
                          'fade'             => 0,
        //@var string
                          'easing'           => '',
        //@var boolean
                          'infinite'         => 0,
        //@var boolean
                          'pauseOnHover'     => 0,
        //@var boolean
                          'pauseOnDotsHover' => 0,
        //@var int
                          'speed'            => 0,
        //@var boolean
                          'swipe'            => 0,
        //@var boolean
                          'touchMove'        => 0,
        //@var boolean
                          'vertical'         => 0,
        //@var boolean
                          'rtl'              => 0,
        //@var string
                          'scrollSpeed'      => 0,
                         ];

    protected $effectsTypes = [
        //@var boolean
                               'autoplay'         => 'integer',
        //@var int
                               'autoplaySpeed'    => 'string',
        //@var boolean
                               'arrows'           => 'integer',
        //@var boolean
                               'centerMode'       => 'integer',
        //@var boolean
                               'dots'             => 'integer',
        //@var boolean
                               'draggable'        => 'integer',
        //@var boolean
                               'fade'             => 'integer',
        //@var string
                               'easing'           => 'string',
        //@var boolean
                               'infinite'         => 'integer',
        //@var boolean
                               'pauseOnHover'     => 'integer',
        //@var boolean
                               'pauseOnDotsHover' => 'integer',
        //@var int
                               'speed'            => 'integer',
        //@var boolean
                               'swipe'            => 'integer',
        //@var boolean
                               'touchMove'        => 'integer',
        //@var boolean
                               'vertical'         => 'integer',
        //@var boolean
                               'rtl'              => 'integer',
        //@var string
                               'scrollSpeed'      => 'string',
                              ];

    /**
     * @param jsonString|array $data
     */
    public function __construct($data = null, $mergeWithDefault = false) {
        if (null === $data) {
            $data = $this->getDefaultEffects();
        }
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        if (is_array($data)) {
            $this->fromArray($data, $mergeWithDefault);
        }
    }

    /**
     * @param array $effects
     */
    protected function fromArray(array $effects, $mergeWithDefault = false) {
        if (true === $mergeWithDefault) {
            $this->effects = $this->getDefaultEffects();
        }

        foreach ($effects as $property => $value) {
            $value = (('on' === $value) ? 1 : $value);
            if (array_key_exists($property, $this->effects)) {

                if (in_array($property, ['autoplaySpeed', 'scrollSpeed'])) {
                    $value = str_replace(',', '.', $value);
                }
                if ($this->effectsTypes[$property]) {
                    settype($value, $this->effectsTypes[$property]);
                }
                $this->effects[$property] = $value;
            }
        }
    }

    public function toArray() {
        return $this->effects;
    }

    /**
     * -------------------------------------------------------------------------
     *               ArrayAccess implementation
     * -------------------------------------------------------------------------
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->effects);
    }

    public function offsetGet($offset) {
        return $this->effects[$offset];
    }

    public function offsetSet($offset, $value) {
        return $this->effects[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->effects[$offset]);
    }

    /**
     * -------------------------------------------------------------------------
     *                      MAGIC
     * -------------------------------------------------------------------------
     */
    public function __toString() {
        return json_encode($this->effects);
    }

    /**
     * -------------------------------------------------------------------------
     *                      DATA
     * -------------------------------------------------------------------------
     */
    public function getDefaultEffects() {
        return [
                'autoplay'         => false,
                'autoplaySpeed'    => 3,
                'arrows'           => true,
                'centerMode'       => false,
                'dots'             => false,
                'draggable'        => true,
                'fade'             => false,
                'easing'           => 'linear',
                'infinite'         => true,
                'pauseOnHover'     => true,
                'pauseOnDotsHover' => false,
                'speed'            => 1,
                'swipe'            => true,
                'touchMove'        => true,
                'vertical'         => false,
                'rtl'              => false,
                'scrollSpeed'      => 1,
               ];
    }

    /**
     * @return array
     */
    public function getEasingTypes() {
        return [
                'linear',
                'easeInSine',
                'easeOutSine',
                'easeInOutSine',
                'easeInQuad',
                'easeOutQuad',
                'easeInOutQuad',
                'easeInCubic',
                'easeOutCubic',
                'easeInOutCubic',
                'easeInQuart',
                'easeOutQuart',
                'easeInOutQuart',
                'easeInQuint',
                'easeOutQuint',
                'easeInOutQuint',
                'easeInExpo',
                'easeOutExpo',
                'easeInOutExpo',
                'easeInCirc',
                'easeOutCirc',
                'easeInOutCirc',
                'easeInBack',
                'easeOutBack',
                'easeInOutBack',
                'easeInElastic',
                'easeOutElastic',
                'easeInOutElastic',
                'easeInBounce',
                'easeOutBounce',
                'easeInOutBounce',
               ];
    }

}