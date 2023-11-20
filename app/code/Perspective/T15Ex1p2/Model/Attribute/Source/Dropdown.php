<?php
namespace Perspective\T15Ex1p2\Model\Attribute\Source;

class Dropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
            ['label' => __('Please Select'),    'value' => ''],
            ['label' => __('Google'),           'value' => '1'],
            ['label' => __('Friend'),           'value' => '2'],
            ['label' => __('Email'),            'value' => '3'],
            ['label' => __('Other'),            'value' => '4'],

            ];
        }
        return $this->_options;
    }

   
    public function getOptionText($value) 
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
   
}