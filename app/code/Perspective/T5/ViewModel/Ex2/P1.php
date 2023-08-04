<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\CatalogInventory\Model\Stock\StockItemRepository;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class P1 implements ArgumentInterface
{
    /**
    * @var \Magento\CatalogInventory\Model\Stock\StockItemRepository
    */
    private $_stockItemRepository;

    public function __construct (
        StockItemRepository $stockItemRepository,
    )
    {
        $this->_stockItemRepository = $stockItemRepository;
    }

    public function getStockItem($productId)
    {
        $stockItem = $this->_stockItemRepository->get($productId);
        return $stockItem;
    }

}
