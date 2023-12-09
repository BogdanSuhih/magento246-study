<?php
namespace Perspective\T19CronTopNotification\ViewModel;

class Notification implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_orderCollectionFactory;
    private $_cache;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Perspective\T19CronTopNotification\Cache\Manager $cacheManager,
    )
    {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_cache = $cacheManager;
    }
  
    public function isVisible()
    {
        if ($this->_cache->getValue() === false) {
            return $this->setSalesData();
        }
        return (bool) $this->_cache->getVisibility();
    }

    public function getSales()
    {
        return $this->_cache->getValue();
    }

    public function setSalesData()
    {
        $data = $this->_getSalesData();
        $result = $this->_cache->setValue($data)
                && $this->_cache->setVisibility(1);
        return $result;
    }

    public function setVisibility($data)
    {
        return $this->_cache->setVisibility($data);
    }

    private function _getSalesData()
    {
        $today = date('Y-m-d H:i:s', strtotime('today midnight'));
       // $today = '2023-08-30 00:00:00';

        $orderCollection = $this->_orderCollectionFactory->create()
            ->addFieldToFilter('created_at', ['gteq' => $today]);

        $productIds = [];
        /** @var \Magento\Sales\Model\Order $order */
        foreach ($orderCollection as $order) {
           /** @var  \Magento\Sales\Api\Data\OrderItemInterface $item */
            foreach ($order->getItems() as $item) {
                if(!$item->getParentItemId()) {
                    $productIds[] = $item->getProductId();
                }
            }
        }

        $uniqueProductIds = array_unique($productIds);
        $totalUniqueProducts = count($uniqueProductIds);


        return $totalUniqueProducts;
    }

}
