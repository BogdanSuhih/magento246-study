<?php
declare(strict_types=1);

namespace Perspective\T7\ViewModel\Ex1;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index extends \Magento\Framework\View\Element\Template implements ArgumentInterface
{
    /**
    * @var \Magento\Checkout\Model\Session
    */
    private $_checkoutSession;

    public function __construct (
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    )
    {
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);

    }

    public function getLastOrder()
    {
        $order = $this->_checkoutSession->getLastRealOrder();

        return $order;
    }

}
