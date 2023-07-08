<?php

namespace Perspective\ErsteViewModule\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ErsteViewModel implements ArgumentInterface
{
    public function sayHello()
    {
        return __('Learn Magento 2 ViewModel Layout');
    }
}