<?php
namespace Perspective\ObserverSampleEvent\Controller\Index;

class TestEvent extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(['text' => 'Perspective']);
        
        $this->_eventManager->dispatch('perspective_display_text', ['mp_text' => $textDisplay]);
        
        echo $textDisplay->getText();
        
        exit;
    }
    
}
