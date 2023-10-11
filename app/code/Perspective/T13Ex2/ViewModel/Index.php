<?php
namespace Perspective\T13Ex2\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Perspective\T13Ex2\Helper\Data;
use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\CatalogInventory\Api\StockRegistryInterface;

class Index implements ArgumentInterface
{
    private $_stockRegistry;
    protected $_catalogHelper;
    protected $_inventoryHelper;

    public function __construct(
        Data $helper,
        CatalogHelper $catalogHelper,
        StockRegistryInterface $stockRegistryInterface,
    )
    {
        $this->_inventoryHelper = $helper;
        $this->_catalogHelper = $catalogHelper;
        $this->_stockRegistry = $stockRegistryInterface;
    }

    public function isMsgVisible()
    {
        return $this->_inventoryHelper->isModuleEnable()
            && $this->getProductStockQty() > 0
            && $this->getProductStockQty() <= $this->getThresholdQty();
    }

    public function getThresholdQty()
    {
        return $this->_inventoryHelper->getThreshold();
    }

    public function getProduct()
    {
        return $this->_catalogHelper->getProduct();
    }

    public function getProductStockQty()
    {
        return $this->_stockRegistry->getStockStatus($this->getProduct()->getId())->getQty();
    }

}
