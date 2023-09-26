<?php
namespace Perspective\Consultations\Model\ResourceModel\Consultation;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'perspective_consultations_consultation_collection';
    protected $_eventObject = 'consultation_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perspective\Consultations\Model\Consultation', 'Perspective\Consultations\Model\ResourceModel\Consultation');
    }
}
