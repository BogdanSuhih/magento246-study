<?php

declare(strict_types=1);

namespace Perspective\Hello\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $page = $this->_pageFactory->create();
        $page->getConfig()
        ->getTitle()
        ->set('6_10. Block');
        return $page;
    }
}