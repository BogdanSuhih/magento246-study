<?php
namespace Perspective\T10Db\Model\ResourceModel\Review;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'review_id';
    protected $_eventPrefix = 'perspective_t10db_review_collection';
    protected $_eventObject = 'review_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\T10Db\Model\Review', 'Perspective\T10Db\Model\ResourceModel\Review');
    }
}
