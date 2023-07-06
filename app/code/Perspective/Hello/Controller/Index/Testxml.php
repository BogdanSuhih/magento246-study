<?php

declare(strict_types=1);

namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Testxml implements ActionInterface
{
    protected $resultFactory;

    public function __construct(RawFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        return $this->resultFactory->create()
        ->setHeader('Content-type', 'text/xml')
        ->setContents('<root><name>Perspective Studio</name><job>Magento Developer</job></root>');
    }
}
