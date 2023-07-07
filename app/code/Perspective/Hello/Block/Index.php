<?php

declare(strict_types=1);

namespace Perspective\Hello\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __('Learn Magento 2 Block Layout');
    }
}
