<?php
namespace Perspective\Consultations\Service;

class Pricing
{
    /**
    * @param \Perspective\Consultations\Model\Consultation $consultation
    */

    public function calculatePrice($consultation)
    {
        $subtotalPrice = $this->getSubtotal($consultation->getData('price'), $consultation->getData('hours'));

        $consultation->setData(
            'subtotal',
            $subtotalPrice
        );
        $discountedPrice = $this->getDiscountedPrice($subtotalPrice, $consultation->getData('discount'), $consultation->getData('multiplier'));
        $consultation->setData(
            'discounted_price',
            $discountedPrice
        );
        return $consultation;
    }

    private function getSubtotal($hourlyRate, $duration) 
    {
        list($hours, $minutes) = explode('.', $duration);
        $minutesInHours = $minutes / 60;
        $totalHours = $hours + $minutesInHours;
        $subtotalPrice = $hourlyRate * $totalHours;

        return round($subtotalPrice,2);
    }

    private function getDiscountedPrice($subtotal, $discount, int $multiplier = 0)
    {
        $discountedPrice = $subtotal - $subtotal*$discount*$multiplier;
        return round($discountedPrice,2);
    }

}
