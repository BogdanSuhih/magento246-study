<?php
namespace Perspective\T13Ex1\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Perspective\T13Ex1\Helper\Data;
use Magento\Catalog\Helper\Data as CatalogHelper;

class Index implements ArgumentInterface
{
    protected $_catalogHelper;
    protected $_currencyHelper;
    protected $_storeManager;
    // protected $_currencyFactory;
    protected $_currencyInterface;


    public function __construct(
        Data $helper,
        CatalogHelper $catalogHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        // \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrencyInterface
    )
    {
        $this->_currencyHelper = $helper;
        $this->_catalogHelper = $catalogHelper;

        $this->_storeManager = $storeManager;
        // $this->_currencyFactory = $currencyFactory;
        
        $this->_currencyInterface = $priceCurrencyInterface;
    }
    
    public function isModuleEnabled()
    {
        return $this->_currencyHelper->isModuleEnable();
    }

    public function getEnabledCurrencies()
    {
        return $this->_currencyHelper->getCurrencies();
    }

    public function getCurrentProduct()
    {
        return $this->_catalogHelper->getProduct();
    }

    public function getCurrentCurrencyCode()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }    
    
    
    public function getAvailableCurrencyCodes($skipBaseNotAllowed = false)
    {
        return $this->_storeManager->getStore()->getAvailableCurrencyCodes($skipBaseNotAllowed);
    }
    
    
    // public function convertPrice($price, $currencyCodeFrom, $currencyCodeTo)
    // {
    //     $rate = $this->_currencyFactory->create()
    //                     ->load($currencyCodeFrom)
    //                     ->getAnyRate($currencyCodeTo);
        
    //     $convertedPrice = $price * $rate;

    //     return $convertedPrice;
    // }

    public function formatPrice(
        $price,
        $currency = null,
        $precision = 2,
        $includeContainer = true,
        $scope = null
    )
    {
        return $this->_currencyInterface->format($price, $includeContainer, $precision, $scope, $currency);
    }

    public function convertAndFormatPrice(
        $price,
        $currency = null,
        $precision = 2,
        $includeContainer = true,
        $scope = null
    )
    {
        return $this->_currencyInterface->convertAndFormat($price, $includeContainer, $precision, $scope, $currency);
    }

    public function getPriceInterface()
    {
        return $this->_currencyInterface;
    }
}
