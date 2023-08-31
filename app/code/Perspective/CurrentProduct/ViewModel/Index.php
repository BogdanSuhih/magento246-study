<?php
namespace Perspective\CurrentProduct\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index extends \Magento\Framework\View\Element\Template implements ArgumentInterface
{
    protected $_registry;
    protected $_helperData;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Data $helperData,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->_helperData = $helperData;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct() {
        return $this->_registry->registry('current_product');
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    public function getCurrentProductHelper()
    {
        return $this->_helperData->getProduct();
    }
    public function getCurrentCategoryHelper()
    {
        return $this->_helperData->getCategory();
    }
}
