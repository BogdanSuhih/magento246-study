<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    protected $_collectionFactory;
    protected $_filter;

    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Ui\Component\MassAction\Filter $filter,
       \Perspective\BlogManager\Model\ResourceModel\Blog\CollectionFactory $collectionFactory
    )
    {
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $status = $this->getRequest()->getParam('status');
            $statusLabel = $status ? "enabled" : "disabled";
            $count = 0;
            foreach ($collection as $model) {
                $model->setStatus($status);
                $model->save();
                $count++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 blog(s) have been %2.', $count, $statusLabel));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Perspective_BlogManager::edit');
    }
}
