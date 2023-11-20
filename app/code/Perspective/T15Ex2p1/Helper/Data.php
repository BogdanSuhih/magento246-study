<?php
namespace Perspective\T15Ex2p1\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $isset = $this->scopeConfig->isSetFlag('social_discount_section/general/enable', $scope);
        return $isset;
    }

    public function getDiscountRate($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 'social_discount_section/general/discount_rate';
        return $this->scopeConfig->getValue($path, $scope);
    }

}
