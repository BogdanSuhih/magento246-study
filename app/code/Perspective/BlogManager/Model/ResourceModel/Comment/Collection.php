<?php
namespace Perspective\BlogManager\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'perspective_blogmanager_comment_collection';
    protected $_eventObject = 'comment_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\BlogManager\Model\Comment', 'Perspective\BlogManager\Model\ResourceModel\Comment');
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}
