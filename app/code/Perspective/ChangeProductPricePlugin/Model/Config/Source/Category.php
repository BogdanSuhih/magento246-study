<?php
namespace Perspective\ChangeProductPricePlugin\Model\Config\Source;

class Category implements  \Magento\Framework\Data\OptionSourceInterface
{
    protected $_categoryFactory;
    protected $_collectionFactory;

    public function __construct(
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $optionArray = [];
        $arr = $this->_toArray();
        foreach ($arr as $key => $value) {
                $optionArray[] = [
                    'value' => $key,
                    'label' => $value,
                ];
        }
        return $optionArray;
    }

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }

    private function _toArray()
    {
        $categories = $this->getCategoryCollection(false, false, false, false);

        $catagoryList = array();
        foreach ($categories as $category)
        {
            $catagoryList[$category->getEntityId()] = __($this->_getParentName($category->getPath()) . $category->getName());
        }

        return $catagoryList;
    }

    private function _getParentName($path = '')
    {
        $parentName = '';
        $rootCats = array(1,2);

        $catTree = explode("/", $path);
        // Deleting category itself
        array_pop($catTree);

        if($catTree && (count($catTree) > count($rootCats)))
        {
            foreach ($catTree as $catId)
            {
                if(!in_array($catId, $rootCats))
                {
                    $category = $this->_categoryFactory->create()->load($catId);
                    $categoryName = $category->getName();
                    $parentName .= $categoryName . ' -> ';
                }
            }
        }

        return $parentName;
    }
    
}
