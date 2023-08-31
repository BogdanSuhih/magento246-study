<?php
namespace Perspective\Cookie\Controller\Cookie;

class DeleteCookie extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $_cookieManager;
    /**
     * @var \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
     */
    protected $_cookieMetadataFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
       \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
    )
    {
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $name = \Perspective\Cookie\Controller\Cookie\AddCookie::COOKIE_NAME;
        $metadata = $this->_cookieMetadataFactory->createPublicCookieMetadata()
        ->setDurationOneYear()
        ->setPath('/')
        ->setHttpOnly(false);

        $this->_cookieManager->deleteCookie($name, $metadata);
        echo "Deleted";
    }
}