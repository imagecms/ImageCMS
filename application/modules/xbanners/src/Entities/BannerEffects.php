<?php

namespace Banners\Entities;

/**
 * @author cray
 */
class BannerEffects implements \ArrayAccess {

    protected $effects = [
        //@var boolean
        "autoplay" => 0,
        //@var int
        "autoplaySpeed" => 0,
        //@var boolean
        "arrows" => 0,
        //@var boolean
        "centerMode" => 0,
        //@var boolean
        "dots" => 0,
        //@var boolean
        "draggable" => 0,
        //@var boolean
        "fade" => 0,
        //@var string
        "easing" => "",
        //@var boolean
        "infinite" => 0,
        //@var boolean
        "pauseOnHover" => 0,
        //@var boolean
        "pauseOnDotsHover" => 0,
        //@var int
        "speed" => 0,
        //@var boolean
        "swipe" => 0,
        //@var boolean
        "touchMove" => 0,
        //@var boolean
        "vertical" => 0,
        //@var boolean
        "rtl" => 0,
    ];

    /**
     * @param jsonString|array $data
     */
    public function __construct($data = null, $mergeWithDefault = false) {
        if (null === $data) {
            $data = $this->getDefaultEffects();
        }
        if (is_string($data)) {
            $data = json_decode($data,true);
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
            if (key_exists($property, $this->effects)) {
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
        return key_exists($offset, $this->effects);
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
            "autoplay" => 0,
            "autoplaySpeed" => 3,
            "arrows" => 1,
            "centerMode" => 0,
            "dots" => 0,
            "draggable" => 1,
            "fade" => 0,
            "easing" => 'linear',
            "infinite" => 1,
            "pauseOnHover" => 1,
            "pauseOnDotsHover" => 0,
            "speed" => 300,
            "swipe" => 1,
            "touchMove" => 1,
            "vertical" => 0,
            "rtl" => 0,
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
