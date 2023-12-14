<?php
namespace Perspective\M1T2Countdown\ViewModel;

use GuzzleHttp\Psr7\FnStream;
use Magento\Catalog\Model\Product;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    const DATE_FORMAT = 'd-m-Y';
    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    private $_ruleResource;
    private $_ruleFactory;
    private $_catalogHelper;
    private $_customerSession;
    private $_date;

    /**
     * @var Product
     */
    private $_currentProduct;

    public function __construct(
        \Magento\Catalog\Helper\Data $catalogHelper,
        \Magento\CatalogRule\Model\ResourceModel\Rule $rule,
        \Magento\CatalogRule\Model\RuleFactory $ruleFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
    )
    {
        $this->_catalogHelper = $catalogHelper;
        $this->_ruleResource = $rule;
        $this->_ruleFactory = $ruleFactory;
        $this->_customerSession = $customerSession;
        $this->_date = $timezoneInterface;
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

    public function getSpecialEnd()
    {
        $endDate = $this->getCurrentProduct()->getSpecialToDate();
        
        $result = $endDate ? $this->formatDate($endDate, 'Y-m-d'). " 23:59:59" : false;
        return $result;
    }

    public function getProductRules()
    {
        $product = $this->getCurrentProduct();
        $productId = $product->getId();
        $websiteId = $product->getStore()->getWebsiteId();
        $customerGroupId = $this->_customerSession->getCustomerGroupId();
        $timeZoneDate = $this->formatDate();

        $rules = $this->_ruleResource->getRulesFromProduct($timeZoneDate, $websiteId, $customerGroupId, $productId);
        return $rules;
    }

    public function getRuleName($ruleId)
    {
        $rule = $this->_ruleFactory->create()->load($ruleId);
        if ($rule->getId()) {
            $ruleName = $rule->getName();
            return $ruleName;
        }
        return false;
    }

    public function getMinActiveTime(array $times)
    {
        $currentTime = $this->formatDate();

        $filteredTimes = array_filter($times, function ($time) use ($currentTime) {
            return $time >= $currentTime;
        });

        $minTime = empty($filteredTimes) ? null : min($filteredTimes);

        return $minTime;
    }

    /**
     * @param mixed|null $date
     * @param string|null $format
     * @return string
     */
    public function formatDate($date = null, $format = null)
    {
        if (!$format) {
            $format = self::DATE_TIME_FORMAT;
        }

        return $this->_date->date($date)->format($format);
    }
}
