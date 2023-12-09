<?php
namespace Perspective\T19CronTopNotification\Controller\Action;

class Close implements \Magento\Framework\App\ActionInterface
{

    protected $_resultJsonFactory;
    protected $_notification;

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Perspective\T19CronTopNotification\ViewModel\Notification $notification,
        )
    {
        $this->_resultJsonFactory = $jsonFactory;
        $this->_notification = $notification;
    }

    public function execute()
    {
        /**bool $result*/

        $result = $this->_notification->setVisibility(0);

        return $this->_resultJsonFactory->create()
        ->setHeader('Content-Type', 'application/json')
        ->setData(['success' => $result]);
    }
}
