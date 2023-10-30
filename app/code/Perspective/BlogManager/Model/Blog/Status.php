<?php
namespace Perspective\BlogManager\Model\Blog;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['label' => 'Disabled', 'value' => 0];
        $options[] = ['label' => 'Enabled', 'value' => 1];
        return $options;
    }
}
