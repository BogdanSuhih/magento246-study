<?php
namespace Perspective\TutorialEntity\Block;

use Magento\Catalog\Api\Data\ProductInterface;

class EntityResource extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $_productFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product
     */
    private $_productResource;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $_collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product $productResource,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_productFactory = $productFactory;
        $this->_productResource = $productResource;
        $this->_collectionFactory = $collectionFactory;
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

    public function getCheapProducts($price)
    {
        if (is_null($price)){
            return null;
        }
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*')
        ->addAttributeToFilter(ProductInterface::PRICE, ['lt'=>$price])
        ->load();
        return $collection->getItems();
    }
}
