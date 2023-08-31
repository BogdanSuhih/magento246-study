<?php
namespace Perspective\Cookie\Controller\Cookie;

class ReadCookie extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $_cookieManager;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
    )
    {
        $this->_cookieManager = $cookieManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $name = \Perspective\Cookie\Controller\Cookie\AddCookie::COOKIE_NAME;
        $value = $this->_cookieManager->getCookie($name);
        echo $value;
    }
}