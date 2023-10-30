<?php
namespace Perspective\BlogManager\Controller\Manage;

class Save extends \Magento\Customer\Controller\AbstractAccount
{

    protected $_blogFactory;
    //protected $_customerSession;
    protected $_dataHelper;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Perspective\BlogManager\Model\BlogFactory $blogFactory,
       \Perspective\BlogManager\Helper\Data $dataHelper,     
       //\Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_dataHelper = $dataHelper;
        //$this->_customerSession = $customerSession;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $customerId = $this->_dataHelper->getCustomerId();
        //$customerId = $this->_customerSession->getCustomerId();

        if (isset($data['id']) && $data['id']) {
            $isAuthorised = $this->_blogFactory->create()->getCollection()
                                              ->addFieldToFilter('user_id', $customerId)
                                              ->addFieldToFilter('entity_id', $data['id'])
                                              ->getSize();
            if (!$isAuthorised) {
                $this->messageManager->addError(__('You are not authorised to edit this blog.'));
                return $this->resultRedirectFactory->create()->setPath('blog/manage');
            } else {
                $model = $this->_blogFactory->create()->load($data['id']);
                $model->setTitle($data['title'])
                      ->setContent($data['content'])
                      ->save();
                $this->messageManager->addSuccess(__('You have updated the blog successfully.'));
            }
        } else {
            $model = $this->_blogFactory->create();
            $model->setData($data);
            $model->setUserId($customerId);
            $model->save();
            $this->messageManager->addSuccess(__('Blog saved successfully.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('blog/manage');
    }    
}
