<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P3 implements ArgumentInterface
{
    /**
    * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
    */
    private $_customerFactory;

    public function __construct(
        CollectionFactory $customerFactory,
         
    ) {
        $this->_customerFactory = $customerFactory;
    }

    public function getCustomerCollection()
    {
        $collection = $this->_customerFactory->create();
        $collection->addAttributeToSelect('*')->load();
        return $collection;
    }
}
