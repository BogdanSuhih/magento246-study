<?php
namespace Perspective\SystemConfigExample\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;

class Data extends AbstractHelper
{
    protected $_encryptor;

    public function __construct(
        Context $context, 
        EncryptorInterface $encryptor
    )
    {
        parent::__construct($context);
        $this->_encryptor = $encryptor;
    }

    /**
    * @param string $scope
    * @return bool
    */
   public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
   {
       return $this->scopeConfig->isSetFlag('perspective/general/enabled', $scope);
   }
   
   /**
    * @param string $scope
    * @return string
    */
   public function getTitle($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
   {
       return $this->scopeConfig->getValue('perspective/general/title', $scope);
   }
   
   /**
    * @param string $scope
    * @return string
    */
   public function getSecret($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
   {
       $secret = $this->scopeConfig->getValue('perspective/general/secret', $scope);
       $secret = $this->_encryptor->decrypt($secret);
       
       return $secret;
   }
   
   /**
    * @param string $scope
    * @return string
    */
   public function getOption($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
   {
       return $this->scopeConfig->getValue('perspective/general/option', $scope);
   }
}
