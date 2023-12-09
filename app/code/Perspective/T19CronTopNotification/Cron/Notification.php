<?php
namespace Perspective\T19CronTopNotification\Cron;

class Notification
{

    protected $_notification;
    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Perspective\T19CronTopNotification\ViewModel\Notification $notification,
    ) {
        $this->_notification = $notification;
        $this->_logger = $logger;
    }

   /**
    * 
    *
    * @return void
    */
    public function execute() {


        $result = $this->_notification->setSalesData();

        $this->_logger->info(
            sprintf(
                'update_sales_notification_cronjob is finished. Sales result: %s',
                $this->_notification->getSales()
            )
        );
    }
}
