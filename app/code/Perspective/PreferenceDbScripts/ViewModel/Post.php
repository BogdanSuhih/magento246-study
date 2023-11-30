<?php
namespace Perspective\PreferenceDbScripts\ViewModel;

class Post extends \Perspective\DbScripts\ViewModel\Post
{
    public function getPostCollection(){
        $collection = $this->postFactory->create()->getCollection();
        foreach ($collection as $item) {
            $item->prefName()->shortUrl();
        }
        return $collection;
    }
}
