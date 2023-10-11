<?php
namespace Perspective\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    protected $_helperData;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Perspective\Helloworld\Helper\Data $helperData
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_helperData = $helperData;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        echo $this->_helperData->getGeneralConfig('enable');
        echo $this->_helperData->getGeneralConfig('display_text');
        exit;
        return $this->_pageFactory->create();
    }
}
