<?php
namespace Perspective\T15Ex2p2\ViewModel;

use Magento\Catalog\Helper\Data as CatalogHelper;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_dataHelper;
    private $_catalogHelper;
    private $_currencyInterface;
    private $_options;
    private $_currentProduct;

    public function __construct(
        \Perspective\T15Ex2p2\Helper\Data $helper,
        CatalogHelper $catalogHelper,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrencyInterface,
        \Perspective\T15Ex2p2\Model\Source\Options $options

    )
    {
        $this->_dataHelper = $helper;
        $this->_catalogHelper = $catalogHelper;
        $this->_currencyInterface = $priceCurrencyInterface;
        $this->_options = $options;

    }

     /**
     * @param null|\Magento\Catalog\Model\Product $product
     * @return bool
     */

    public function isMsgVisible()
    {
        return $this->_dataHelper->isModuleEnable()
            && $this->getProductAirFreightValue()
            && $this->getProductWeight() > $this->getTresholdWeight();
    }

    /**
     * @return string|int Weight Threshold
     */

    public function getTresholdWeight()
    {
        $optionValue = $this->getProductAirFreightValue();
        return $this->_dataHelper->getWeight($optionValue);
    }

    public function getProductWeight()
    {
        return $this->getCurrentProduct()->getWeight();
    }

    /**
     * @return string|int Additional Cost per lbs
     */
    
    public function getCost()
    {
        $optionValue = $this->getProductAirFreightValue();
        return $this->_dataHelper->getCost($optionValue);
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */

    public function getCurrentProduct()
    {
    
        if (!$this->_currentProduct) {
            $this->_currentProduct = $this->_catalogHelper->getProduct();
        }
        return $this->_currentProduct;
    }

    public function getProductAirFreightValue()
    {
        return $this->getCurrentProduct()->getData('air_freight_only');
    }

    public function getProductAirFreightLable()
    {
        return $this->_options->getOptionText($this->getProductAirFreightValue());
    }

    /**
     * @return string Converted and formated price value
     */
  
    public function getAdditionalCost()
    {
        $cost = $this->getCost() * ceil($this->getProductWeight() - $this->getTresholdWeight());
        return $this->_currencyInterface->convertAndFormat($cost);
    }

}
