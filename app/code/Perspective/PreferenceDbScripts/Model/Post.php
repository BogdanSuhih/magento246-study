<?php
namespace Perspective\PreferenceDbScripts\Model;

class Post extends \Perspective\DbScripts\Model\Post
{

    public function prefName()
    {
        $this->setData('pref_name', 'magento2_name ' . $this->getName());
        return $this;
    }

    public function shortUrl()
    {
        $url = $this->getData('url_key');
        $this->setData('short_url', str_replace('/magento-2-module-development', '', $url));
        return $this;
    }
}
