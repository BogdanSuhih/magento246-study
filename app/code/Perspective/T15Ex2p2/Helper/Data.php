<?php
namespace Perspective\T15Ex2p2\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $isset = $this->scopeConfig->isSetFlag('air_freight_only_section/general/enable', $scope);
        return $isset;
    }

    public function getWeight($optionValue, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 'air_freight_only_section/'.$optionValue.'_group/'.$optionValue.'_weight';
        return $this->scopeConfig->getValue($path, $scope);
    }

    public function getCost($optionValue, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 'air_freight_only_section/'.$optionValue.'_group/'.$optionValue.'_cost';
        return $this->scopeConfig->getValue($path, $scope);
    }
}
