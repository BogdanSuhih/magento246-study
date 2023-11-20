<?php
namespace Perspective\ColorAttribute\ViewModel;

class AddEnableColorAttribute implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_registry;

    public function __construct(
        \Magento\Framework\Registry $registry
    )
    {
        $this->_registry = $registry;
    }
    
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

}
