<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex1;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P1 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
    */
    private $_collectionFactory;
    /**
    * @var \Magento\Catalog\Model\ProductFactory
    */
    private $_productFactory;
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product
    */
    private $_productResource;

    public function __construct (
        CollectionFactory $collectionFactory,
        ProductFactory $productFactory,
        Product $productResource        
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_productFactory = $productFactory;
        $this->_productResource = $productResource;
    }

    public function getProductById($productId)
    {
        if (is_null($productId)) {
            return null;
        }
        $productModel = $this->_productFactory->create();
        $this->_productResource->load($productModel, $productId);
        return $productModel;
    }

    /**
     * Get category collection
     *
     * @param bool $isActive
     * @param bool|int $level
     * @param bool|string $sortBy
     * @param bool|int $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */
    public function getCategoryCollection (
        $isActive = true,
        $level = false, 
        $sortBy = false, 
        $pageSize = false
    )
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        if ($isActive) {
            $collection->addIsActiveFilter();
        }
        if ($level) {
            $collection->addLevelFilter($level);
        }
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        } 

        return $collection;
    }

}
