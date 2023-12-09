<?php
namespace Perspective\CronSample\Cron;

use Psr\Log\LoggerInterface;

class HalfAnHour
{
    protected $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }
    /*
    * @return void
    */
    public function execute() {
        $this->logger->debug('It\'s half an hour');
        
    }

}
