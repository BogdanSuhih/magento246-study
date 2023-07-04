<?php
namespace Perspective\Helloworld\Block;

class Index extends \Magento\Framework\View\Element\Template
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

    public function sayHello()
	{
		return __('Hello World');
	}

    public function sayphp()
	{
        phpinfo();
		return 0;
	}
}
