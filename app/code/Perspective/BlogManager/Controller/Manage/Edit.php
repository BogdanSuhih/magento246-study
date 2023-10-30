<?php
namespace Perspective\BlogManager\Controller\Manage;

class Edit extends \Magento\Customer\Controller\AbstractAccount
{

    protected $_resultPageFactory;
    protected $_blogFactory;
    //protected $_customerSession;
    protected $_dataHelper;
    protected $_messageManager;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $resultPageFactory,
       \Perspective\BlogManager\Model\BlogFactory $blogFactory,
       //\Magento\Customer\Model\Session $customerSession,
       \Perspective\BlogManager\Helper\Data $dataHelper,     
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_blogFactory = $blogFactory;
        //$this->_customerSession = $customerSession;
        $this->_dataHelper = $dataHelper;
        return parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->_dataHelper->getCustomerId();
        //$customerId = $this->_customerSession->getCustomerId();
        $isAuthorised = $this->_blogFactory->create()
                            ->getCollection()
                            ->addFieldToFilter('user_id', $customerId)
                            ->addFieldToFilter('entity_id', $blogId)
                            ->getSize();

        if (!$isAuthorised) {
            $this->messageManager->addErrorMessage(__('You are not authorised to edit this blog.'));
            return $this->resultRedirectFactory->create()->setPath('blog/manage');
        }
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Blog'));
        return $resultPage;
    }
}
