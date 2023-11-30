<?php
namespace Perspective\PreferenceContactForm\Block;

class ContactForm extends \Magento\Contact\Block\ContactForm
{
    public function getText()
    {
        return "Override Text";
    }
}
