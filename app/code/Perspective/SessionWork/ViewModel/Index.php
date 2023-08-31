<?php
namespace Perspective\SessionWork\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    private $_customerSession;
    private $_checkoutSession;
    private $_catalogSession;
    
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Model\Session $catalogSession,
    )
    {
        $this->_customerSession = $customerSession;
        $this->_checkoutSession = $checkoutSession;
        $this->_catalogSession = $catalogSession;
    }

    public function getCustomerSession()
    {
        return $this->_customerSession;
    }
    public function getCheckoutSession()
    {
        return $this->_checkoutSession;
    }
    public function getCatalogSession()
    {
        return $this->_catalogSession;
    }
}
