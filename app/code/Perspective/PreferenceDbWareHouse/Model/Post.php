<?php
namespace Perspective\PreferenceDbWareHouse\Model;

class Post extends \Perspective\DbWareHouse\Model\Post
{
    public function getProdsPrice()
    {
        $id = $this->getData('id_prod');
        $product = $this->productRepository->getById($id);
        $price = $product->getFinalPrice();

        return $this->getData('kol_prod') * $price;
    }
}
