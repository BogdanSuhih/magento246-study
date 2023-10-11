<?php
namespace Perspective\SystemConfigExample\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Perspective\SystemConfigExample\Helper\Data;

class Config implements ArgumentInterface
{
    protected $_helper;

    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    public function isEnabled()
    {
        return $this->_helper->isEnabled();
    }

    public function getTitle()
    {
        return $this->_helper->getTitle();
    }

    public function getSecret()
    {
        return $this->_helper->getSecret();
    }

    public function getOption()
    {
        return $this->_helper->getOption();
    }
}
