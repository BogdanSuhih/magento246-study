<?php
declare(strict_types=1);

namespace Perspective\T7\ViewModel\Ex3;

class Index implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Wishlist\Model\Wishlist
     */
    private $_wishlist;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $_modelSession;

    public function __construct(
        \Magento\Wishlist\Model\Wishlist $wishlist,
        \Magento\Customer\Model\Session $modelSession,

    ) {
        $this->_wishlist = $wishlist;
        $this->_modelSession = $modelSession;
    }

    public function getCustomerId()
    {
        if (!$this->_modelSession->isLoggedIn()) {
            return false;
        }
        return $this->_modelSession->getCustomerId();
    }
    
    public function getWishlistByCustomerId($customerId)
    {
        $wishlist = $this->_wishlist->loadByCustomerId($customerId)->getItemCollection();
        return $wishlist;
    }
}