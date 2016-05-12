<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\FareSearch;


class OriginDestinationInformation
{

    public $DepartureDateTime;
    public $OriginLocationCode;
    public $DestinationLocationCode;

    public function __construct($origin, $destination, $date)
    {
        $this->DestinationLocationCode = $origin;
        $this->OriginLocationCode = $destination;
        $this->DepartureDateTime = $date.'T00:00:00';
    }

}