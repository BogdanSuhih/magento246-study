<?php
namespace Perspective\T19CronTopNotification\Block;

class Notification extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        if ($this->_isAllowed()) {
            parent::_prepareLayout();
        } else {
            $this->setTemplate(false);
        }
    }

    protected function _isAllowed()
    {
        $controller = $this->getRequest()->getControllerName();
        $module = $this->getRequest()->getModuleName();

        $allowedControllers = ['index', 'category'];
        $allowedModules = ['cms', 'catalog'];

        return in_array($module, $allowedModules) && in_array($controller, $allowedControllers);
    }
}
