<?php
namespace Perspective\UiExample\Model;

use Perspective\UiExample\Model\ResourceModel\Blog as BlogResourceModel;

class Blog extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {

        $this->_init(BlogResourceModel::class);
    }
}
