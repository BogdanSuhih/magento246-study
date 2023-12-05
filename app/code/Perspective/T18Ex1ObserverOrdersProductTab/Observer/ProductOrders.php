<?php
namespace Perspective\T18Ex1ObserverOrdersProductTab\Observer;

class ProductOrders implements \Magento\Framework\Event\ObserverInterface
{
    private $_orderItemCollectionFactory;
    private $_timezoneInterface;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $orderItemCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface
    ) {
        $this->_orderItemCollectionFactory = $orderItemCollectionFactory;
        $this->_timezoneInterface = $timezoneInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $productId = $product->getId();
        $productTypeId = $product->getTypeId();
        
        if ($productTypeId === 'grouped') {
            $associatedProducts = $product->getTypeInstance()->getAssociatedProducts($product);

            $productIds = [];
            foreach ($associatedProducts as $associatedProduct) {
                $productIds[] = $associatedProduct->getId();
            }
            $orderItems = $this->_getOrdersCollection($productIds)->getItems();
        } else {
            $orderItems = $this->_getOrdersCollection([$productId])->getItems();
        }

        $totalQtyByDate = [];
        foreach ($orderItems as $orderItem) {
            $createdDate = $this->_formatDate($orderItem->getData('created_at'));
            $qtyOrdered = $orderItem->getData('qty_ordered');

            if (!isset($totalQtyByDate[$createdDate])) {
                $totalQtyByDate[$createdDate] = 0;
            }

            $totalQtyByDate[$createdDate] += $qtyOrdered;
        }

        $product->setData('orders', $totalQtyByDate);
        return $this;
    }

    private function _getOrdersCollection($productsId, $size = null)
    {
        $orderItemCollection = $this->_orderItemCollectionFactory->create();
        $orderItemCollection->addFieldToFilter('product_id', ["in" => $productsId]);
        if($size) {
            $orderItemCollection->setPageSize($size);
        }
        $orderItemCollection->setOrder('created_at', 'DESC');
        
        return $orderItemCollection;        
    }

    private function _formatDate($date, $format = 'd M Y'): string
    {
        $formattedDate = $this->_timezoneInterface->date(new \DateTime($date), null, true, false)->format($format);

        return $formattedDate;    
    }
}