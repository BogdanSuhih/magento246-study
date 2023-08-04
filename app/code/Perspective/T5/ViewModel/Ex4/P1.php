<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex4;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class P1 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_productCollectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
    }

    public function getBundleProducts()
    {
        $productCollection = $this->_productCollectionFactory->create();

        $productCollection->addAttributeToFilter('type_id', ['eq' => 'bundle'])
        ->addAttributeToSelect('*')->addOptionsToResult();

        $bundleProducts = $productCollection->getItems();

        foreach ($bundleProducts as $bundleProduct) {
            $childrenProducts = $this->getChildrenProducts($bundleProduct);

            $bundleProduct->setData('children_products', $childrenProducts);
        }

        return $bundleProducts;
    }

    protected function getChildrenProducts($bundleProduct)
    {

        $bundleTypeInstance = $bundleProduct->getTypeInstance();
        $selectionsCollection = $bundleTypeInstance->getSelectionsCollection(
            $bundleTypeInstance->getOptionsIds($bundleProduct),
            $bundleProduct
        );
        $childrenProducts = $selectionsCollection->addAttributeToSelect('*')
        ->addAttributeToSort('sku', 'ASC')
        ->getItems();
        ksort($childrenProducts);
        return $childrenProducts;
    }


}