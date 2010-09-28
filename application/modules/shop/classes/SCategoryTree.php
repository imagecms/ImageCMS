<?php
/**
 * Create category tree. This class will add to each tree element next virtual columns: Level, Subtree, FullUriPath.
 * 
 * @package Shop
 * @version $id$
 * @author <dev@imagecms.net>
 */
class SCategoryTree {

    // Single-dimensional array tree. Default mode.
    // In this mode each array key is category id.
    const MODE_SINGLE = 0; 
    // Multi-dimensional array tree. 
    const MODE_MULTI = 1;

    public $categories = array();
    public $tree = array();
    public $categoryUrlPrefix = '/shop/category/'; // Url prefix for links in UL tree. See $this->ul().

    protected $multi = false;
    protected $level = -1;
    protected $path = array();
    protected $pathIds = array();
    private $_initialized = false;

    public function __construct()
    {
        // Select all categories
        if ($this->_initialized == false)
            $this->loadCategories(); 

        $this->_initialized = true;

        return $this;
    }

    public function getTree($mode = SCategoryTree::MODE_SINGLE)
    {
        // Set tree mode
        $this->multi = (bool) $mode;

        $this->tree = $this->createTree();
        return $this->tree;
    }

    /**
     * Create categories multidimensional tree array.
     * 
     * @access public
     * @return array
     */
    public function createTree($ownerId = null)
    {
        $result = array();

        /**
         *  Loop only thru categories with parent_id NULL. eg. root categories.
         */
        $this->level++;
        foreach ($this->categories as $category)
        {
            if ($category->getParentId() == $ownerId)
            {
                // Add categor url to full path.
                $this->path[] = $category->getUrl();
                $this->pathIds[] = $category->getId();

                $category->setVirtualColumn('level', $this->level);
                $category->setVirtualColumn('fullUriPath', $this->path); // Full uri path to category
                $category->setVirtualColumn('fullPathIdsVirtual', $this->pathIds);

                if ($this->multi===true)
                {
                    $category->setVirtualColumn('subtree', $this->createTree($category->getId())); 
                    $result[] = $category;
                }
                else
                {
                    $result[$category->getId()] = $category;
                    $subtree = $this->createTree($category->getId());

                    foreach ($subtree as $key)
                        $result[$key->getId()] = $key;
                }

                // Decrease full path for one element.
                array_pop($this->path);
                array_pop($this->pathIds);
            }
        }
        $this->level--;

        return $result;
    }

    /**
     * Load categories list
     * 
     * @access public
     */
    public function loadCategories()
    {
        $this->categories = SCategoryQuery::create()
            ->orderByPosition('ASC')
            ->find();

        return $this;
    }

    /**
     * Remove category orphans after deleting some category
     * 
     * @access public
     * @return integer number of delete categories
     */
    public function removeOrphans()
    {
        $orphans = array();

        // Reload categories array
        $this->loadCategories();
        $tree = $this->getTree();

        foreach ($this->categories as $category)
        {
            if (!isset($tree[$category->getParentId()]) && $category->getParentId() != 0)
                array_push($orphans, $category->getId());
        }

        if (sizeof($orphans) > 0)
        {
            $criteria = new Criteria();
            $criteria->add(SCategoryPeer::ID, $orphans, Criteria::IN);
            SCategoryPeer::doDelete($criteria);
        }

        return sizeof($orphans);
    }

    /**
     * Create UL list
     * 
     * @access public
     * @return string
     */
    public function ul($activeID=null)
    {
        ob_start();
        $this->_walkArray(ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI), $activeID);
        return ob_get_clean();
    }

    /**
     * _walkArray 
     * 
     * @access protected
     */
    protected function _walkArray($array, $activeID=null)
    {
		foreach($array as $key)
		{
            if ($key->getId() == $activeID)
    			echo '<li>'.ShopCore::encode($key->getName()).'</a>';
            else
    			echo '<li><a href="'.$this->categoryUrlPrefix.$key->getFullPath().'">'.ShopCore::encode($key->getName()).'</a>';

			if(sizeof($key->getSubtree()))
			{
				echo '<ul>';
			    $this->_walkArray($key->getSubtree(),$activeID);
				echo '</ul>';
			}
			echo '</li>';
		} 
    }
}
