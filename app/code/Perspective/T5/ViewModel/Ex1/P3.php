<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex1;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P3 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
    ) {
        $this->_collectionFactory = $collectionFactory;
    }

    public function getProductCollectionByCategories($categories)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('name')
        ->addCategoriesFilter(['in'=>$categories]);
        return $collection;
    }
}