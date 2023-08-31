<?php
declare(strict_types=1);

namespace Perspective\T7\ViewModel\Ex4;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    /**
    * @var \Magento\Backend\Model\Session\Quote
    */
    protected $_backendModelSession;

    public function __construct(
        \Magento\Backend\Model\Session\Quote $backendModelSession
    ) {
        $this->_backendModelSession = $backendModelSession;
    }

    
	public function setBackendQuote(){
	    $customerId = 1;
	    $quoteId = 1;
		
	    $this->_backendModelSession->setCustomerId($customerId);
	    $this->_backendModelSession->setQuoteId($quoteId);
	    $this->_backendModelSession->setStoreId(1);
	}
	
	public function getBackendQuote(){
		$quote = $this->_backendModelSession->getQuote();
		return $quote;
	}


}