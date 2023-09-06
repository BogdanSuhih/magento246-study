<?php
namespace Perspective\T10Db\Service;

class ReviewGenerator
{
    protected $_customerRepository;
    protected $_searchCriteriaBuilder;
    protected $_productRepository;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    )
    {
        $this->_customerRepository = $customerRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_productRepository = $productRepository;
    }

    /**
     * Get review data array
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface[] $products
     * @param \Magento\Customer\Api\Data\CustomerInterface[] $customers
     * @return array
     */

    public function generateReview($products = null, $customers = null){
        if (!$products) {
            $products = $this->getRandomProducts();
        }

        if (!$customers) {
            $customers = $this->getRandomCustomers();
        }
        $data = [];

        foreach ($products as $product) {
            foreach ($customers as $customer) {
                $textRev = $this->_getRandomReview();
                $data[] = [
                    'product_id' => $product->getId(),
                    'text_rev'=> $textRev,
                    'customer_name'=> $customer->getFirstname(),
                    'customer_email'=> $customer->getEmail(),
                ];
            }
        }

        return $data;
    }


    public function getRandomProducts(int $num = 1){
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $products = $this->_productRepository->getList($searchCriteria)->getItems();
        shuffle($products); 
        return array_slice($products, 0, $num);
    }

    public function getRandomCustomers(int $num = 1){
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $customerItems = $this->_customerRepository->getList($searchCriteria)->getItems();
        shuffle($customerItems); 
        return array_slice($customerItems, 0, $num);
    }

    private function _getReviewsFromFile()
    {
        $filePath = __DIR__ . '/reviews.php';
        
        if (file_exists($filePath)) {
            return include $filePath;
        }
        
        return [];
    }

    private function _getRandomReview(){
        
        $reviews = $this->_getReviewsFromFile();
    
        if (!empty($reviews)) {
            $randomIndex = array_rand($reviews);
            return $reviews[$randomIndex];
        }
    
        return null;
    }

}
