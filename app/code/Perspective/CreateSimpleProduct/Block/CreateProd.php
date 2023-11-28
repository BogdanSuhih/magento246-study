<?php
namespace Perspective\CreateSimpleProduct\Block;

class CreateProd extends \Magento\Framework\View\Element\Template
{
    protected $_productFactory;
    protected $_productRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
        $this->_productFactory = $productFactory;
        $this->_productRepository = $productRepository;

        parent::__construct($context, $data);
    }

    public function crPr()
    {
        $product = $this->_productFactory->create();
        $product->setSku('wa-2'); 
        $product->setName('Wali2'); 
        $product->setAttributeSetId(4); 
        $product->setStatus(1);
        $product->setWeight(10);
        $product->setVisibility(4); 
        //$product->setTaxClassId(0); 
        // $product->setTypeId('simple');
        $product->setPrice(100); 
        // $product->setStockData(
        //     array(
        //         'use_config_manage_stock' => 0,
        //         'manage_stock' => 1,
        //         'is_in_stock' => 1,
        //         'qty' => 999999999
        //     )
        // );
        $product->save();

        return $product;
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }
}
