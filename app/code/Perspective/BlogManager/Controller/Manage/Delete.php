<?php
namespace Perspective\BlogManager\Controller\Manage;

class Delete extends \Magento\Customer\Controller\AbstractAccount
{
    protected $_blogFactory;
    protected $_dataHelper;
    //protected $_customerSession;
    protected $_jsonData;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Perspective\BlogManager\Model\BlogFactory $blogFactory,
       \Perspective\BlogManager\Helper\Data $dataHelper,     
       //\Magento\Customer\Model\Session $customerSession,
       \Magento\Framework\Json\Helper\Data $jsonData
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_dataHelper = $dataHelper;
        //$this->_customerSession = $customerSession;
        $this->_jsonData = $jsonData;
        return parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->_dataHelper->getCustomerId();
        //$customerId = $this->_customerSession->getCustomerId();
        $isAuthorised = $this->_blogFactory->create()->getCollection()
                                           ->addFieldToFilter('user_id', $customerId)
                                           ->addFieldToFilter('entity_id', $blogId)
                                           ->getSize();
        if (!$isAuthorised) {
            $msg = __('You are not authorised to delete this blog.');
            $success = 0;

            // $this->messageManager->addError(__('You are not authorised to delete this blog.'));
            // return $this->resultRedirectFactory->create()->setPath('blog/manage');
        } else {
            $blog = $this->_blogFactory->create()->load($blogId);
            $blog->delete();

            $msg = __('You have successfully deleted the blog.');
            $success = 1;

            // $this->messageManager->addSuccess(__('You have successfully deleted the blog.'));
            // return $this->resultRedirectFactory->create()->setPath('blog/manage/');
        }
        $this->getResponse()->setHeader('Content-type', 'application/javascript');
        $this->getResponse()->setBody(
            $this->_jsonData->jsonEncode(
                [
                    'success' => $success,
                    'message' => $msg
                ]
            )
        );
    }
}
