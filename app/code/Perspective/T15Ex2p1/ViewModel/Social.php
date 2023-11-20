<?php
namespace Perspective\T15Ex2p1\ViewModel;

use Perspective\T15Ex2p1\Helper\Data;
use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class Social implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_socialDiscountHelper;
    private $_catalogHelper;
    protected $_currencyInterface;

    private $_currentProduct;

    public function __construct(
        Data $helper,
        CatalogHelper $catalogHelper,
        PriceCurrencyInterface $priceCurrencyInterface
    )
    {
        $this->_socialDiscountHelper = $helper;
        $this->_catalogHelper = $catalogHelper;
        $this->_currencyInterface = $priceCurrencyInterface;

    }
     /**
     * @param null|\Magento\Catalog\Model\Product $product
     * @return bool
     */

    public function isMsgVisible($product = null)
    {
        return $this->_socialDiscountHelper->isModuleEnable()
            && $this->isSocialEnabled($product);
    }

    /**
     * @return string|int Discount percentage
     */

    public function getSocialDiscount()
    {
        return $this->_socialDiscountHelper->getDiscountRate();
    }

    /**
     * @return string Converted and formated price value
     */
  
    public function getSocialPrice()
    {

        $priceInfo = $this->getCurrentProduct()->getPriceInfo();
        $amountPrice = $priceInfo->getPrice('final_price')->getValue();
        $discountAmount = $amountPrice * $this->getSocialDiscount() /100;
        $socialProce = $amountPrice - $discountAmount;

        return $this->_currencyInterface->format($socialProce);
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

    protected function isSocialEnabled($product = null)
    {
        if (!$product) {
            return $this->getCurrentProduct()->getData('social');
        }
        return $product->getData('social');
    }

}
