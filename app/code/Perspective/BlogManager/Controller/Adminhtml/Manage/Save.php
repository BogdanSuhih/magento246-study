<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Perspective_BlogManager::save';

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
        $data = $this->getRequest()->getParams();
        if (isset($data['entity_id']) && $data['entity_id']) {
            $model = $this->_blogFactory->create()->load($data['entity_id']);
            $model->setTitle($data['title'])
            ->setContent($data['content'])
            ->setStatus($data['status']);
            if (isset($data['products'])) {
                $model->setProducts(implode(',', $data['products']));
            } else {
                $model->setProducts('');
            }
            $model->save();
            $this->messageManager->addSuccessMessage(__('You have updated the blog successfully.'));
        } else {
            $model = $this->_blogFactory->create();
            $model->setTitle($data['title'])
            ->setContent($data['content'])
            ->setStatus($data['status']);
            if (isset($data['products'])) {
                $model->setProducts(implode(',', $data['products']));
            } else {
                $model->setProducts('');
            }
            $model->save();
            $this->messageManager->addSuccessMessage(__('You have successfully created the blog.'));
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Is the user allowed to view the page.
    *
    * @return bool
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
