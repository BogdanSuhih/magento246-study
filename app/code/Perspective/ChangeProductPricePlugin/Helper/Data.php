<?php
namespace Perspective\ChangeProductPricePlugin\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $isset = $this->scopeConfig->isSetFlag('category_discount/general/enable', $scope);
        return $isset;
    }

    public function getRate($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 'category_discount/general/discount_rate';
        return $this->scopeConfig->getValue($path, $scope);
    }

    public function getCategories($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 'category_discount/general/category';
        return $this->scopeConfig->getValue($path, $scope);
    }
}