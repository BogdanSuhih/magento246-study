<?php
namespace Perspective\ChangeProductPricePlugin\Plugin;

class ChangeProductPriceByCategories
{
    protected $_helper;

    public function __construct(
        \Perspective\ChangeProductPricePlugin\Helper\Data $helper,
    )
    {
        $this->_helper = $helper;
    }

    public function getDiscountCategories()
    {
        return explode(',',$this->_helper->getCategories());
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $productCategories = $subject->getCategoryIds();
        $discountCategories = $this->getDiscountCategories();
        if (
            $this->_helper->isModuleEnable()
            && array_intersect($productCategories, $discountCategories)
        ) {
            $result -= $result * ($this->_helper->getRate() / 100);
        }

        return $result;
    }

}