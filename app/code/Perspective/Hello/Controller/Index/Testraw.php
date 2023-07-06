<?php

declare(strict_types=1);

namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Testraw implements ActionInterface
{
    protected $resultFactory;

    public function __construct(RawFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        return $this->resultFactory->create()->setContents("<i><b>Result RawFactory</b></i> <br><i>Perspective Studio</i>");
    }
}
