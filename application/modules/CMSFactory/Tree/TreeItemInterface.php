<?php namespace CMSFactory\Tree;

/**
 * Interface TreeItemInterface
 *
 * @package CMSFactory\Tree
 */
interface TreeItemInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getParentId();

}