<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\BookFlight;


class AirTraveler
{

    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';
    
    public $DateOfBirth;
    public $Gender;
    public $PassengerType;

    public $PassengerName;
    public $Passport;

    public function __construct($travelerInfo)
    {
        $this->DateOfBirth = $travelerInfo['DateOfBirth'];
        $this->Gender = $travelerInfo['Gender'];
        $this->PassengerType = $travelerInfo['PassengerType'];

        $this->PassengerName = new PassengerName(
            $travelerInfo['PassengerName']['PassengerTitle'],
            $travelerInfo['PassengerName']['PassengerFirstName'],
            $travelerInfo['PassengerName']['PassengerLastName']
        );
        $this->Passport = new Passport(
            $travelerInfo['Passport']['PassportNumber'],
            $travelerInfo['Passport']['ExpiryDate'],
            $travelerInfo['Passport']['Country']
        );
    }

}

class PassengerName{



    public $PassengerTitle;
    public $PassengerFirstName;
    public $PassengerLastName;

    protected $availableTitle = [
        'MR',
        'MRS',
        'MISS',
        'INF',
        'LADY'
    ];

    public function __construct($title, $firstname, $lastname)
    {
        $this->PassengerTitle = in_array($title, $this->availableTitle) ? $title : 'MR';
        $this->PassengerFirstName = $firstname;
        $this->PassengerLastName = $lastname;
    }
}

class Passport{
    public $PassportNumber;
    public $ExpiryDate;
    public $Country;

    public function __construct($nbr, $expirateDate, $countryCode)
    {
        $this->PassportNumber = $nbr;
        $this->ExpiryDate = $expirateDate;
        $this->Country = $countryCode;
    }
}