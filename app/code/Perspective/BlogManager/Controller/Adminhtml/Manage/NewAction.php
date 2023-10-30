<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;

class NewAction extends Action
{
    public function execute()
    {
        $this->_forward('edit');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Perspective_BlogManager::add');
    }
}
