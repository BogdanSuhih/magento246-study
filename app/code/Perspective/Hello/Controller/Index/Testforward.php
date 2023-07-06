<?php

declare(strict_types=1);

namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;

class Testforward implements ActionInterface
{
    protected $forwardFactory;

    public function __construct(ForwardFactory $forwardFactory)
    {
        $this->forwardFactory = $forwardFactory;
    }

    public function execute()
    {
        return $this->forwardFactory->create()->forward('testxml');
    }
}