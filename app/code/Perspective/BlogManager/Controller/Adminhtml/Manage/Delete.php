<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

class Delete extends \Magento\Backend\App\Action
{
    protected $_blogFactory;

    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Perspective\BlogManager\Model\BlogFactory $blogFactory
    )
    {
        $this->_blogFactory = $blogFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $blog = $this->_blogFactory->create()->load($id);
            $blog->delete();
            $this->messageManager->addSuccessMessage(__('You deleted the blog.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Perspective_BlogManager::delete');
    }
}
