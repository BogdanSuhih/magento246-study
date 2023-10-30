<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

class Index extends \Magento\Backend\App\Action
{

    protected $_resultPageFactory;

    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_resultPageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Perspective_BlogManager::manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Blog'));
        return $resultPage;

    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Perspective_BlogManager::manage');
    }
}
