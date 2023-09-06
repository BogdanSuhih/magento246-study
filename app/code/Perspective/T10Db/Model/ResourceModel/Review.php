<?php
namespace Perspective\T10Db\Model\ResourceModel;

class Review extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('perspective_t10db_review', 'review_id');
    }
}
