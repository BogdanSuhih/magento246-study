<?php
declare(strict_types=1);

namespace Perspective\T7\ViewModel\Ex2;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    /**
    * @var \Magento\Checkout\Model\Session
    */
    private $_checkoutSession;
    protected $_cart;    
    public function __construct(     
      \Magento\Checkout\Model\Cart $cart,
      \Magento\Checkout\Model\Session $checkoutSession,
    )
    {
		$this->_cart = $cart;
		$this->_checkoutSession = $checkoutSession;	
    }
    
    public function getCart()
    {		
		return $this->_cart;
    }
	
    public function getCheckoutSession()
    {
		return $this->_checkoutSession;
    }

}
