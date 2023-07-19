<?php
namespace Perspective\Customers\ViewModel;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    protected $customerRepository;
    protected $searchCriteriaBuilder;
    protected $filterBuilder;
    protected $sortOrderBuilder;
    protected $customerFactory;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        CustomerFactory $customerFactory
    )
    {
        $this->customerRepository = $customerRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->customerFactory = $customerFactory;
    }

    public function getAll() 
    {
        $customers = $this->customerFactory->create()->getCollection()->load();
        return $customers;
    }

    public function getCustomers() 
    {
        $sortOrder = $this->sortOrderBuilder
        ->setAscendingDirection()
        ->setField('lastname')
        ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $this->searchCriteriaBuilder->addFilter(
            CustomerInterface::EMAIL,
            '%gmail.com',
            'like'
        );
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $customersItems = $this->customerRepository->getList($searchCriteria);
        return $customersItems->getItems();
    }
}
