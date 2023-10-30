<?php
namespace Perspective\BlogManager\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $customerSession;
    protected $_date;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->customerSession = $customerSession;
        $this->_date = $date;
        parent::__construct($context);
    }

    public function getCustomerId()
    {
        $customerId = $this->customerSession->getCustomerId();
        return $customerId;
    }

    public function getFormattedDate($date='')
    {
        return $this->_date->date($date)->format('d/m/y h:i A');
    }
}
