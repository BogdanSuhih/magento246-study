<?php
namespace Perspective\BlogManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_collectionFactory;
    protected $_filter;

    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Ui\Component\MassAction\Filter $filter,
       \Perspective\BlogManager\Model\ResourceModel\Blog\CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_filter = $filter;
        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $count = 0;
            foreach ($collection as $item) {
                $item->delete();
                $count++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 blog(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }

    /**
     * Is the user allowed to view the page.
    *
    * @return bool
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Perspective_BlogManager::delete');
    }
}
