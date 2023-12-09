<?php
namespace Perspective\CronAutoRefreshCache\Cron;

class AutoRefreshCache
{
    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    private $_cacheTypeList;

    public function __construct(
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
    )
    {
        $this->_cacheTypeList = $cacheTypeList;
    }
    public function execute()
    {
        $invalidcache = $this->_cacheTypeList->getInvalidated();
        foreach($invalidcache as $key => $value) {
          $this->_cacheTypeList->cleanType($key);
        }
    }
}