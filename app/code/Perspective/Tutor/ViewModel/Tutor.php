<?php
namespace Perspective\Tutor\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Tutor implements ArgumentInterface
{
    private $_productRepository;
    private $_searchCriteriaBuilder;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_productRepository = $productRepository;
    }

    public function getProductById($productId)
    {
        if(is_null($productId)){
            return null;
        }

        $productModel = $this->_productRepository->getById($productId);
        return $productModel;
    }

    public function getCheapProducts($price)
    {
        if(is_null($price)){
            return null;
        }

        $this->_searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            $price,
            'lt'
        );
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $productCollection = $this->_productRepository->getList($searchCriteria);
        return $productCollection->getItems();
    }
}
