<?php
namespace Perspective\TutorialProductPage\Helper;

class Custom extends \Magento\Framework\App\Helper\AbstractHelper
{
    private $_availableSku = [
        'MJ01',
        'Mj01',
        'MJ02'
    ];

    public function validateProductBySku($sku)
    {
        if (in_array($sku, $this->getValidSkuArray())) {
            return true;
        } else {
            return false;
        }
    }
    protected function getValidSkuArray() {
        return $this->_availableSku;
    }
}
