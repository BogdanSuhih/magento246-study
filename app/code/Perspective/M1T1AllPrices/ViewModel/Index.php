<?php
namespace Perspective\M1T1AllPrices\ViewModel;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_dataHelper;
    private $_catalogHelper;
    private $_currencyInterface;

    /**
     * @var Product
     */
    private $_currentProduct;

    public function __construct(
        \Perspective\M1T1AllPrices\Helper\Data $helper,
        \Magento\Catalog\Helper\Data $catalogHelper,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrencyInterface,
    )
    {
        $this->_dataHelper = $helper;
        $this->_catalogHelper = $catalogHelper;
        $this->_currencyInterface = $priceCurrencyInterface;
    }

     /**
     * @return bool
     */

    public function isModuleEnable()
    {
        return $this->_dataHelper->isModuleEnable();
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

    public function getBasePrice()
    {
        if ($this->_dataHelper->isPriceTypeEnabled('base_price')) {
            $regularPrice = '';

            if ($this->getCurrentProduct()->getTypeId() == 'simple') {
                $regularPrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('regular_price')->getValue();
            }
            if ($this->getCurrentProduct()->getTypeId() == 'configurable') {
                /** @var \Magento\ConfigurableProduct\Pricing\Price\ConfigurableRegularPrice $basePrice */
                $basePrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('regular_price');
                $regularPrice = $basePrice->getMinRegularAmount()->getValue();
            }
            if ($this->getCurrentProduct()->getTypeId() == 'bundle') {
                /** @var \Magento\Bundle\Pricing\Price\BundleRegularPrice $basePrice */
                $basePrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('regular_price');
                $regularPrice = $basePrice->getMinimalPrice()->getValue();
            }

            $label = 'Base price';
            if ($regularPrice) {
                return '<p> <b>'. __($label) .': </b>'. $this->_currencyInterface->format($regularPrice) . '</p>';
            }
            return '<p> <b>'. __($label) .': </b>-- </p>';
        }
        return null;
    }

    public function getFinalPrice()
    {
        if ($this->_dataHelper->isPriceTypeEnabled('final_price')) {

            $finalPrice = '';
            if (($this->getCurrentProduct()->getTypeId() == 'configurable' 
                || $this->getCurrentProduct()->getTypeId() == 'simple'
            )) {
                $finalPrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('final_price')->getValue();
            }

            if ($this->getCurrentProduct()->getTypeId() == 'bundle') {
                /** @var \Magento\Bundle\Pricing\Price\FinalPrice $basePrice */
                $basePrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('final_price');
                $finalPrice = $basePrice->getMinimalPrice()->getValue();
            }

            $label = 'Final price';
            if ($finalPrice) {
                return '<p> <b>'. __($label) .': </b>'. $this->_currencyInterface->format($finalPrice) . '</p>';
            }
            return '<p> <b>'. __($label) .': </b>-- </p>';

        }
        return null;
    }

    public function getSpecialPrice()
    {
        if ($this->_dataHelper->isPriceTypeEnabled('special_price')) {
            $specialPrice = '';

            if (($this->getCurrentProduct()->getTypeId() == 'configurable' 
                || $this->getCurrentProduct()->getTypeId() == 'simple'
            )) {
                $specialPrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('special_price')->getValue();
            }

            if ($this->getCurrentProduct()->getTypeId() == 'bundle') {
                /** @var \Magento\Bundle\Pricing\Price\FinalPrice $basePrice */
                $basePrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('final_price');
                $specialPrice = $basePrice->getMinimalPrice()->getValue();
            }

            $label = 'Special price';
            if ($specialPrice) {
                return '<p> <b>'. __($label) .': </b>'. $this->_currencyInterface->format($specialPrice) . '</p>';
            }
            return '<p> <b>'. __($label) .': </b>-- </p>';

        }
        return null;

    }

    public function getTierPrice()
    {
        if ($this->_dataHelper->isPriceTypeEnabled('tier_price')) {
            $result = [];

            if ($this->getCurrentProduct()->getTypeId() == 'simple') {
                $tprices = $this->getCurrentProduct()->getTierPrices();
                $result = [];
                if ($tprices) {
                    foreach ($tprices as $tierPrice) {
                        /** @var \Magento\Catalog\Model\Product\TierPrice $tierPrice*/
                        $result[round($tierPrice->getQty(), 0)] = $this->_currencyInterface->format($tierPrice->getValue());
                    }
                }
            }
            return $result;
        }
        return null;
    }

    public function getCatalogRulePrice()
    {
        if ($this->_dataHelper->isPriceTypeEnabled('catalog_rule_price')) {
            $rulePrice = '';

            if ($this->getCurrentProduct()->getTypeId() == 'simple'
            ) {
                $rulePrice = $this->getCurrentProduct()->getPriceInfo()->getPrice('catalog_rule_price')->getValue();
            }

            $label = 'Catalog rule price';
            if ($rulePrice) {
                return '<p> <b>'. __($label) .': </b>'. $this->_currencyInterface->format($rulePrice) . '</p>';
            }
            return '<p> <b>'. __($label) .': </b>-- </p>';

        }
        return null;

    }

}
