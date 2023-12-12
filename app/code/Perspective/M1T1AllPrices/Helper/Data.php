<?php
namespace Perspective\M1T1AllPrices\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    const XML_PATH_ALLPRICES_GENERAL_ENABLE = 'all_prices_section/general/enable';
    const XML_PATH_ALLPRICES_GENERAL  = 'all_prices_section/general';

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $isset = $this->scopeConfig->isSetFlag(self::XML_PATH_ALLPRICES_GENERAL_ENABLE . '', $scope);
        return $isset;
    }

    public function isPriceTypeEnabled($priceType, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = self::XML_PATH_ALLPRICES_GENERAL .'/'. $priceType;
        return $this->scopeConfig->getValue($path, $scope);
    }

}
