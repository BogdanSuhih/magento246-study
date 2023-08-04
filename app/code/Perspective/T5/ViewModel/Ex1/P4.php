<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex1;

use Magento\Catalog\Model\Product\Attribute\Source\Status as ProductStatus;
use Magento\Catalog\Model\Product\Visibility as ProductVisibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P4 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
    */
    private $_collectionFactory;
    /**
    * @var \Magento\Catalog\Model\Product\Attribute\Source\Status
    */
    private $_productStatus;
    /**
    * @var \Magento\Catalog\Model\Product\Visibility
    */
    private $_productVisibility;

    public function __construct (
        CollectionFactory $collectionFactory,
        ProductStatus $productStatus,
        ProductVisibility $productVisibility        
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_productStatus = $productStatus;
        $this->_productVisibility = $productVisibility;
    }

    public function getProductCollectionCategoriesVisibleEnable()
    {
        $collection = $this->_collectionFactory->create();
        $visibility = $this->_productVisibility->getVisibleInSiteIds();
        $status = $this->_productStatus->getVisibleStatusIds();

        $collection->addAttributeToSelect('*')
        ->addAttributeToFilter('status', ['in' => $status])
        ->setVisibility($visibility);
        return $collection;
    }
}
