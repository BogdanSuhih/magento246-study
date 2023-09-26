<?php
namespace Perspective\Consultations\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Perspective\Consultations\Model\ResourceModel\Consultation\CollectionFactory as ConsultationCollectionFactory;
use Perspective\Consultations\Service\Pricing;

class Index implements ArgumentInterface
{

    private $_consultationCollectionFactory;
    private $_customerRepository;
    private $_groupRepository;
    private $_consultationPricing;

    public function __construct(
        ConsultationCollectionFactory $collectionFactory,
        CustomerRepositoryInterface $customerRepository,
        GroupRepositoryInterface $groupRepository,
        Pricing $consultationPricing
    )
    {
        $this->_consultationCollectionFactory = $collectionFactory;
        $this->_customerRepository = $customerRepository;
        $this->_groupRepository = $groupRepository;
        $this->_consultationPricing = $consultationPricing;
    }

    public function getGroupedByName(){

        $collection = $this->_consultationCollectionFactory->create();
        $collection
        ->addFieldToSelect('*')
        ->setOrder('name', 'ASC');

        $groupedData = [];
        $previousName = null;
        $groupedTotal = 0;

        foreach ($collection->getItems() as $item) {
            $name = $item->getName();

            if ($name !== $previousName) {
                if(isset ($previousName)){
                    $groupedData[$previousName]['total'] = $groupedTotal;
                }
                $groupedTotal = 0;
                $groupedData[$name]['consultations'] = [];
                $previousName = $name;
            }
            $customer = $this->_customerRepository->getById($item->getData("customer_id"));
            $item->setData('customer', $customer);
            $customerGroup = $this->_groupRepository->getById($customer->getGroupId());
            $item->setData('customer_group', $customerGroup->getCode());

            $isGoldCustomer = $customerGroup->getCode() === 'Gold';
            $hours = (new \DateTime($item->getData("date")))->format('H');
            
            if($hours >= 8 && $hours <= 11 && $isGoldCustomer) {
                $multiplier = 3;
            } elseif ($isGoldCustomer) {
                $multiplier = 2;
            } else if ($hours >= 8 && $hours <= 11) {
                $multiplier = 1;
            } else {
                $multiplier = 0;
            }
            
            $item->setData('multiplier', $multiplier);

            $this->_consultationPricing->calculatePrice($item);

            $groupedTotal += $item->getData('discounted_price');

            $groupedData[$name]['consultations'][] = $item;
        }
        $groupedData[$previousName]['total'] = $groupedTotal;
        return $groupedData;
    }



}
