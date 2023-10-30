<?php
namespace Perspective\BlogManager\Block;

class Blog extends \Magento\Framework\View\Element\Template
{
    protected $_blogFactory;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\BlogManager\Model\BlogFactory $blogFactory,
        array $data = []
    ) {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getBlog()
    {
        $blogId = $this->getRequest()->getParam('id');
        $blog = $this->_blogFactory->create()->load($blogId);
        return $blog;
    }
}
