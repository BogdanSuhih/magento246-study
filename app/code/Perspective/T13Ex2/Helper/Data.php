<?php
namespace Perspective\T13Ex2\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag('t13ex2/general/enable', $scope);
    }

    public function getThreshold($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 't13ex2/general/threshold';
        return $this->scopeConfig->getValue($path, $scope);
    }

}
