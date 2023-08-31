<?php
namespace Perspective\RegistryAlternative\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index extends \Magento\Framework\View\Element\Template implements ArgumentInterface
{
    /**
     * @var CategoryInterface|null
     */
    protected $_category;
    
    private $_currentCategoryService;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Perspective\RegistryAlternative\Service\CurrentCategory $currentCategoryService,
        array $data = []
    )
    {
        $this->_currentCategoryService = $currentCategoryService;
        parent::__construct($context, $data);
    }

    public function getCategoryUrl() {
        return $this->getCategory()->getUrl();
    }

    public function getCurrentProduct() {
        return;
    }

    public function getCategoryName()
    {
        if (!$this->getCategory()) {
            return '';
        }

        return $this->getCategory()->getName();
    }

    /**
     * @return \Magento\Catalog\Api\Data\CategoryInterface|null
     */
    private function getCategory()
    {
        return $this->_currentCategoryService->getCategory();
    }
}
