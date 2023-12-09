<?php
namespace Perspective\T19CronTopNotification\Cache;

class Manager
{
    const CACHE_KEY_SALES_VALUE = 'today_sales_notification_value';
    const CACHE_KEY_SALES_VISIBLE = 'today_sales_notification_visible_status';

    private $_cacheInterface;

    public function __construct(
        \Magento\Framework\App\CacheInterface $cacheInterface,
    )
    {
        $this->_cacheInterface = $cacheInterface;
    }

    public function getValue()
    {
        $cache = $this->_cacheInterface->load(SELF::CACHE_KEY_SALES_VALUE);
        return $cache;
    }

    public function setValue(int $data)
    {
        $cache = $this->_cacheInterface->save($data, SELF::CACHE_KEY_SALES_VALUE);
        return $cache;
    }

    public function getVisibility()
    {
        $cache = $this->_cacheInterface->load(SELF::CACHE_KEY_SALES_VISIBLE);
        return $cache;
    }

    public function setVisibility(int $data)
    {
        $cache = $this->_cacheInterface->save($data, SELF::CACHE_KEY_SALES_VISIBLE);
        return $cache;
    }
}
