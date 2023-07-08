<?php

declare(strict_types=1);

namespace Perspective\ErsteViewModule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected $context;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->resultPageFactory = $pageFactory;
        $this->context = $context;
    }
    
    public function execute()
    {
        $page = $this->resultPageFactory->create();
        return $page;
    }
}
