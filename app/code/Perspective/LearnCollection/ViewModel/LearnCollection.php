<?php
declare(strict_types=1);

namespace Perspective\LearnCollection\ViewModel;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class LearnCollection implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_collectionFactory;
    /**
    * @var \Magento\Catalog\Model\CategoryFactory
    */
    private $_categoryFactory;

    public function __construct (
        CollectionFactory $collectionFactory,
        CategoryFactory $categoryFactory        
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_categoryFactory = $categoryFactory;
    }

    public function getProductCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(3);
        return $collection;
    }

    public function getProductCollectionLikeSku($sku)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*')
        ->addAttributeToFilter('sku', ['like'=>$sku])
        ->setPageSize(10);
        return $collection;
    }

    public function getProductCollectionNameSku()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect(['name','sku']);
        $collection->setPageSize(3);
        return $collection;
    }

    public function getProductCollectionCategories($categories)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addCategoriesFilter(['in'=>$categories])
        ->setPageSize(5);
        return $collection;
    }
    
    public function getProductCollectionCategoriesVisibleEnable($categoryId)
    {
        $category = $this->_categoryFactory->create()->load($categoryId);
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*')
        ->addCategoryFilter($category)
        ->setPageSize(5)
        ->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
        ->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
        return $collection;
    }

    public function getSimpleProduct()
    {
        $collection=$this->_collectionFactory->create();
        $collection->addAttributeToSelect('*')
        ->addAttributeToFilter('type_id',['eq'=>'simple'])
        ->getSelect()->order('created_at', \Magento\Framework\DB\Select::SQL_DESC)
        ->limit(10);
        return $collection;
    }
}
