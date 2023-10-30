<?php
namespace Perspective\BlogManager\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'perspective_blogmanager_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\BlogManager\Model\Blog', 'Perspective\BlogManager\Model\ResourceModel\Blog');
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}
