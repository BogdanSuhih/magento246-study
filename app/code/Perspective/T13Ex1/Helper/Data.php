<?php
namespace Perspective\T13Ex1\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    protected $_currencies = ['EUR', 'PLN', 'USD', 'UAH',];

    public function isModuleEnable($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag('t13ex1/general/enable', $scope);
    }

    public function isCurrencyEnable(string $currency, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 't13ex1/general/'.$currency.'_select';
        return $this->scopeConfig->isSetFlag($path, $scope);
    }

    public function getCurrencyCourse($currency, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $path = 't13ex1/general/'.$currency.'_course';
        return $this->scopeConfig->getValue($path, $scope);
    }

    public function getCurrencies()
    {
        $currencies = [];
        if ($this->isModuleEnable()) {
            foreach ($this->_currencies as $currency) {
                if ($this->isCurrencyEnable($currency)) {
                    $currencies[$currency] = $this->getCurrencyCourse($currency);
                }
            }
        }
        return $currencies;
    }
}
