<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P5 implements ArgumentInterface
{
    private $_collectionFactory;

    public function __construct (
        CollectionFactory $groupCollection,
    )
    {
        $this->_collectionFactory = $groupCollection;
    }

    public function getGroupCollection()
    {
        $collection = $this->_collectionFactory->create();
        
        return $collection;
    }
}
