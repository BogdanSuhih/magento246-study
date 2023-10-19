<?php
namespace Perspective\UiExample\Model\ResourceModel\Blog;

use Perspective\UiExample\Model\Blog as BlogModel;
use Perspective\UiExample\Model\ResourceModel\Blog as BlogResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(BlogModel::class, BlogResourceModel::class);
    }
}
