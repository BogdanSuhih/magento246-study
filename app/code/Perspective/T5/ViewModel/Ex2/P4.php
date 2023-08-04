<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P4 implements ArgumentInterface
{
    /**
    * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
    */
    private $_collectionFactory;

    public function __construct (
        CollectionFactory $collectionFactory,
    )
    {
        $this->_collectionFactory = $collectionFactory;
    }

    public function getOrderCollection ($cusomerId = null)
    {
        $collection = $this->_collectionFactory->create($cusomerId);

        $collection->setOrder('created_at');
        return $collection;
    }

}
