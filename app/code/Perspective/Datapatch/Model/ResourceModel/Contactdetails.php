<?php
namespace Perspective\Datapatch\Model\ResourceModel;

class Contactdetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('customer_contactdetails', 'id');
    }
}
