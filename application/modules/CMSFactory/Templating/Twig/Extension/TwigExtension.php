<?php namespace CMSFactory\Templating\Twig\Extension;

use CMSFactory\Services\Morphy\Morphy;
use Twig_Extension;

class TwigExtension extends Twig_Extension
{

    private $morphy;

    public function __construct(Morphy $morphy) {
        $this->morphy = $morphy;
    }

    public function getFilters() {
        return [
                new \Twig_SimpleFilter('translit', 'translit'),
                new \Twig_SimpleFilter('morphy', [$this->morphy, 'morphy']),
                new \Twig_SimpleFilter('dump', 'dump'),
                new \Twig_SimpleFilter('dd', 'dd'),
                new \Twig_SimpleFilter('lang', 'lang'),
               ];
    }

    public function getFunctions() {
        return [
                new \Twig_SimpleFunction('dump', 'dump'),
                new \Twig_SimpleFunction('dd', 'dd'),
                new \Twig_SimpleFunction('lang', 'lang'),
               ];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName() {
        return 'icms';
    }
}