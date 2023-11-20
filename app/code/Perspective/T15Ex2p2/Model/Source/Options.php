<?php 
namespace Perspective\T15Ex2p2\Model\Source;

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{ 
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [ 
            ['label'=>'None',               'value'=>''],
            ['label'=>'Balloon',            'value'=>'1'],
            ['label'=>'Charter plane',      'value'=>'2'],
            ['label'=>'High-speed plane',   'value'=>'3'],
            ['label'=>'Spaceship',          'value'=>'4']

        ];
        return $this->_options;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
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