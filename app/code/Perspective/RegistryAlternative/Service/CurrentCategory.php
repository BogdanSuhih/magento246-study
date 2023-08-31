<?php
namespace Perspective\RegistryAlternative\Service;

use Magento\Framework\Exception\NoSuchEntityException;

class CurrentCategory
{
    private $_currentCategory;
    private $_categoryId;
    private $_catalogSession;
    private $_categoryRepository;

    public function __construct(
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->_catalogSession = $catalogSession;
        $this->_categoryRepository = $categoryRepository;
    }

    public function getCategoryId()
    {
        if (!$this->_categoryId) {
            $currentCategoryId = $this->_catalogSession->getData('last_viewed_category_id');
            if ($currentCategoryId) {
                $this->_categoryId = (int) $currentCategoryId;
            }
        }
        return $this->_categoryId;
    }

    public function getCategory()
    {
        if (!$this->_currentCategory) {
            $categoryId = $this->getCategoryId();

            if (!$categoryId) {
                return null;
            }

            try {
                $this->_currentCategory = $this->_categoryRepository->get($categoryId);
            } catch (NoSuchEntityException $e) {
                return null;
            }
        }

        return $this->_currentCategory;
    }
}
