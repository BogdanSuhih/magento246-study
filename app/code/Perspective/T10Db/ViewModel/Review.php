<?php
namespace Perspective\T10Db\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

use Perspective\T10Db\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Helper\Image as ImageHelper;
use Magento\Catalog\Api\CategoryRepositoryInterface;

class Review implements ArgumentInterface
{

    private $_reviewCollectionFactory;

    private $_productCollectionFactory;

    private $_imageHelper;
    private $_categoryRepository;

    public function __construct(
        ReviewCollectionFactory $reviewCollectionFactory,
        ProductCollectionFactory $productCollectionFactory,
        ImageHelper $imageHelper,
        CategoryRepositoryInterface $categoryRepository,
        )
    {
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_imageHelper = $imageHelper;
        $this->_categoryRepository = $categoryRepository;
    }

    public function getReviewCollection(){

        $collection = $this->_reviewCollectionFactory->create();
        
        return $collection;
    }

    public function getReviewCollectionByCustomerId(int $customerId){

        $collection = $this->_reviewCollectionFactory->create();

        $collection->getSelect()->join(
            ['customer' => $collection->getTable('customer_entity')],
            'main_table.customer_email = customer.email',
            ['customer_id' => 'customer.entity_id']
        );
        $collection->getSelect()->having('customer_id = ?', $customerId);
        return $collection;
    }

    public function getProductsByCategoryId($categoryId){
        $category = $this->_categoryRepository->get($categoryId);

        $productCollection = $this->_productCollectionFactory->create()
        ->addFieldToSelect('*')
        ->addCategoryFilter($category)
        ->setDataToAll('category_name', $category->getName());

        return $productCollection->getItems();
    }

    public function getReviewCollectionByProductId($productId){

        $reviewCollection = $this->_reviewCollectionFactory->create();
        $reviewCollection->addFieldToFilter('product_id', $productId);
        return $reviewCollection->getItems();
    }

    public function getImageForProduct($product)
    {
        $image = $this->_imageHelper->init($product, 'product_base_image');

        return $image->getUrl();
    }
}
