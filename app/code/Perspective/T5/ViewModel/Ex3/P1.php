<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex3;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory  as ProductCollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P1 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_productCollectionFactory;

    public function __construct(
        ProductCollectionFactory $collectionFactory,
    ) {
        $this->_productCollectionFactory = $collectionFactory;
    }

    public function getProductCollectionByCategories($categories)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection
        ->addAttributeToSelect('*')
        ->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
        ->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
        ->addAttributeToFilter('price', ['gteq'=>50])
        ->addAttributeToFilter('price', ['lteq'=>60])
        ->addCategoriesFilter(['in'=>$categories]);

        return $collection;
    }
}