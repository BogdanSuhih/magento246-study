<?php
namespace Perspective\T15Ex2p1\Plugin\Catalog\Product;

class ListProduct
{
    private $_socialModel;

    public function __construct(
        \Perspective\T15Ex2p1\ViewModel\Social $socialModel
    ) {
        $this->_socialModel = $socialModel;
    }

    public function afterGetLoadedProductCollection(\Magento\Catalog\Block\Product\ListProduct $subject, $collection)
    {
        foreach($collection as $product) {
            if($this->_socialModel->isMsgVisible($product)) {
                $product->setName($product->getName() . ' - SOCIAL!!!');
            }
        }
        return $collection;
    }
}
