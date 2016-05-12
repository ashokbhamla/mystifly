<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\BookFlight;


class TravelerInfo
{
    public $CountryCode;
    public $AreaCode;
    public $Email;
    public $PhoneNumber;
    public $AirTravelers = [];

    public function __construct($info)
    {
        $this->CountryCode = $info['CountryCode'];
        $this->AreaCode = $info['AreaCode'];
        $this->Email = $info['Email'];
        $this->PhoneNumber = $info['PhoneNumber'];
        $this->setAirTravelers($info['AirTravelers']);
    }

    public function setAirTravelers($travelers)
    {
        foreach ($travelers as $traveler){
            $this->AirTravelers[] = new AirTraveler($traveler);
        }
        return $this;
    }

}