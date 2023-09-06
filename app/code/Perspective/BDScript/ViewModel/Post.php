<?php
namespace Perspective\BDScript\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    /**
    * @var \Perspective\BDScript\Model\PostFactory
    */
    private $_postFactory;

    public function __construct(
        \Perspective\BDScript\Model\PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
    }

    public function getPostCollection(){

        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        
        return $collection;
    }

    public function getPostCollectionByIdDesc(){

        $post = $this->_postFactory->create();
        $collection = $post->getCollection()->addOrder('post_id')->addFieldToFilter('post_id',array('nin' => array(3,4)));
        
        return $collection;
    }

}
