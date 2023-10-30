<?php
namespace Perspective\BlogManager\Model\ResourceModel;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('blogmanager_comment', 'entity_id');
    }
}