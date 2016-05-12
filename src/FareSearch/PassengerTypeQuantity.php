<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;


class PassengerTypeQuantity
{

    const PASSENGER_TYPE_ADULT = 'ADT';
    const PASSENGER_TYPE_CHILD = 'CHD';

    protected $availablePassengerType = [
        self::PASSENGER_TYPE_ADULT,
        self::PASSENGER_TYPE_CHILD,
    ];

    public $Code;
    public $Quantity;

    public function __construct($type, $quantity)
    {
        if (!in_array($type, $this->availablePassengerType)) {
            throw new \InvalidArgumentException(sprintf('Passenger type must be %s', implode(",", $this->availablePassengerType)));
        }

        $this->Code = $type;
        $this->Quantity = (int)$quantity;

    }

}