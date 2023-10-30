<?php
namespace Perspective\BlogManager\Block;

class BlogList extends \Magento\Framework\View\Element\Template
{
    protected $_blogCollection;
    //protected $_customerSession;
    protected $_dataHelper;
    protected $_statuses;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\BlogManager\Model\ResourceModel\Blog\CollectionFactory $blogCollection,
        //\Magento\Customer\Model\Session $customerSession,
        \Perspective\BlogManager\Helper\Data $dataHelper,
        \Perspective\BlogManager\Model\Blog\Status $status,
        array $data = []
    ) {
        $this->_blogCollection = $blogCollection;
        //$this->_customerSession = $customerSession;
        $this->_dataHelper = $dataHelper;
        $this->_statuses = $status;
        parent::__construct($context, $data);
    }
    /**
     * Return blog collection
     *
     * @return \Perspective\BlogManager\Model\ResourceModel\Blog\Collection
     */

    public function getBlogs()
    {
        $customerId = $this->_dataHelper->getCustomerId();
        //$customerId = $this->_customerSession->getCustomer()->getId();
        $collection = $this->_blogCollection->create();
        $collection->addFieldToFilter('user_id', ['eq'=>$customerId])
                    ->setOrder('updated_at', 'DESC');
        return $collection;
    }

    public function getStatuses()
    {
        $statuses = [];
        foreach ($this->_statuses->toOptionArray() as $status) {
            $statuses[$status['value']] = $status['label'];
        }
        return $statuses;
    }

    public function getFormattedDate($date)
    {
        return $this->_dataHelper->getFormattedDate($date);
    }

}
