<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Perspective_BlogManager::edit';

    protected $_pageFactory;
    protected $_blogFactory;
    protected $_coreRegistry;

    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Perspective\BlogManager\Model\BlogFactory $blogFactory,
       \Magento\Framework\Registry $coreRegistry,
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_blogFactory = $blogFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $blogModel = $this->_blogFactory->create()->load($blogId);
        $this->_coreRegistry->register('blog_data', $blogModel);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("Edit Blog"));
        return $resultPage;

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        // $resultPage = $this->_pageFactory->create();
        // $resultPage->setActiveMenu('Perspective_BlogManager::manage');
        // $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));
        // return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
