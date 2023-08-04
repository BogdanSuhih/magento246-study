<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex4;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class P2 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_productCollectionFactory;
    /**
    * @var \Magento\GroupedProduct\Model\Product\Type\Grouped
    */
    private $_groupedProductType;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\GroupedProduct\Model\Product\Type\Grouped $groupedProductType,
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_groupedProductType = $groupedProductType;
    }


    public function getGroupedProducts()
    {
        $productCollection = $this->_productCollectionFactory->create();

        $productCollection->addAttributeToFilter('type_id', 'grouped')
        ->addAttributeToSelect('*')
        ->load();

        $groupedProducts = $productCollection->getItems();

        foreach ($groupedProducts as $groupedProduct) {
            $associatedProductCollection = $this->_groupedProductType->getAssociatedProductCollection($groupedProduct);
            $associatedProducts = $associatedProductCollection->addAttributeToSelect('*')
            ->addAttributeToSort('sku')->load()
            ->getItems();
    
            $groupedProduct->setData('associated_products', $associatedProducts);
        }

        return $groupedProducts;
    }

}