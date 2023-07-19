<?php
namespace Perspective\Category\ViewModel;

use Magento\Catalog\Api\CategoryListInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    protected $categoryFactory;
    protected $categoryListInterface;
    protected $searchCriteriaBuilder;
    protected $sortOrderBuilder;

    public function __construct(
        CategoryFactory $categoryFactory,
        CategoryListInterface $categoryListInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->categoryListInterface = $categoryListInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    public function getCategoriesData() 
    {
        $categories = $this->categoryFactory->create()->getCollection()->loadData();
        return $categories;
    }

    public function getCategories()
    {
        $sortOrder = $this->sortOrderBuilder->setField('created_at')->setDescendingDirection()->create();
        $searchCriteria = $this->searchCriteriaBuilder->addSortOrder($sortOrder)->create();
        return $this->categoryListInterface->getList($searchCriteria);
    }
}
