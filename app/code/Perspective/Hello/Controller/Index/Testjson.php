<?php

declare(strict_types=1);

namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Testjson implements ActionInterface
{
    protected $jsonFactory;

    public function __construct(JsonFactory $jsonFactory)
    {
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        return $this->jsonFactory->create()
            ->setHeader('Content-Type', 'application/json')
            ->setData([
            'name' => 'Alister',
            'job' => 'Perspective Studio',
            'salary' => '1000'
            ]);
    }
}
