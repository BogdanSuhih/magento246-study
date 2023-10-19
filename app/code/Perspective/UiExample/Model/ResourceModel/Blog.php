<?php
namespace Perspective\UiExample\Model\ResourceModel;

class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('perspective_uiexample', 'blog_id');
    }
}
