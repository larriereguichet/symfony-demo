<?php

namespace FormationBundle\Entity\Behavior;

/**
 * Class VendableTrait.
 */
trait VendableTrait
{
    /**
     * @var float
     */
    private $priceHT;

    /**
     * @return float
     */
    public function getPriceHT()
    {
        return $this->priceHT;
    }

    /**
     * @param float $priceHT
     *
     * @return $this
     */
    public function setPriceHT($priceHT)
    {
        $this->priceHT = $priceHT;

        return $this;
    }
}
