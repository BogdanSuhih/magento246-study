<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex1;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class P2 implements ArgumentInterface
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
    * @var \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory
    */
    private $_ruleCollectionFactory;
    /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    private $_storeManagerInterface;

    public function __construct (
        ProductFactory $productFactory,
        Product $productResource,
        CollectionFactory $ruleCollectionFactory,
        StoreManagerInterface $storeManagerInterface        
    )
    {
        $this->_productFactory = $productFactory;
        $this->_productResource = $productResource;
        $this->_ruleCollectionFactory = $ruleCollectionFactory;
        $this->_storeManagerInterface = $storeManagerInterface;
    }

    public function getCatalogPriceRuleProductIds()
    {
        $websiteId = $this->_storeManagerInterface->getStore()->getWebsiteId();

        $catalogRuleCollection = $this->_ruleCollectionFactory->create();
        $catalogRuleCollection->addFieldToFilter('is_active', 1)->load();

        foreach ($catalogRuleCollection as $catalogRule) {
            $productIdsAccToRule = $catalogRule->getMatchingProductIds();
            foreach ($productIdsAccToRule as $productId => $ruleProductArray) {
                if (!empty($ruleProductArray[$websiteId])) {
                    $resultProductIds[$productId] = $catalogRule->getName();
                }
            }
        }
        return $resultProductIds;
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

}
