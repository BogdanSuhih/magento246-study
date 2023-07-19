<?php
namespace Perspective\SimpleProduct\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    protected $productRepository;
    protected $searchCriteriaBuilder;
    protected $sortOrder;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder

    )
    {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
    }

    public function getProductsByCriteria(
        string $fromLetter = '',
        int $minPrice = 0,
        int $maxPrice = 0,
        string $sortDirection = 'ASC',
        string $sortField = 'price',
        int $pageSize = 20
    )
    {
        if (!empty($fromLetter)){
            $this->searchCriteriaBuilder->addFilter(
                ProductInterface::NAME,
                $fromLetter,
                'like'
            );
        }
        if (!empty($minPrice)){
            $this->searchCriteriaBuilder->addFilter(
                ProductInterface::PRICE,
                $minPrice,
                'gteq'
            );
        }
        if (!empty($maxPrice)){
            $this->searchCriteriaBuilder->addFilter(
                ProductInterface::PRICE,
                $maxPrice,
                'lteq'
            );
        }
        $sortOrder = $this->sortOrder->setField($sortField)->setDirection($sortDirection);
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);

        $this->searchCriteriaBuilder->setPageSize($pageSize);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $productCollection = $this->productRepository->getList($searchCriteria);
        return $productCollection->getItems();

    }
}
