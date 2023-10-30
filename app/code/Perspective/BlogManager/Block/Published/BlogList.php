<?php
namespace Perspective\BlogManager\Block\Published;

class BlogList extends \Magento\Framework\View\Element\Template
{
    protected $_blogCollection;
    protected $_blogList;
    protected $_dataHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\BlogManager\Model\ResourceModel\Blog\CollectionFactory $blogCollection,
        \Perspective\BlogManager\Helper\Data $dataHelper,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        array $data = []
    ) {
        $this->_dataHelper = $dataHelper;
        $this->_blogCollection = $blogCollection;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        if (!$this->_blogList) {
            $collection = $this->_blogCollection->create();
            $collection->addFieldToFilter('status', 1);
            $collection->setOrder('created_at', 'DESC');
            $this->_blogList = $collection;
        }
        return $this->_blogList;
    }
    
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getAuthor($userId)
    {
        if ($userId) {
            $customer = $this->customerFactory->create()->load($userId);
            if ($customer && $customer->getId()) {
                return $customer->getName();
            }
        }
        return __('Admin');
    }

    public function getFormattedDate($date)
    {
        return $this->_dataHelper->getFormattedDate($date);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'blogmanager.publishedblog.pager'
            )->setCollection(
                $this->getCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCollection()->load();
        }
        return $this;
    }
}
