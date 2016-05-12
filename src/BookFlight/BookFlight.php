<?php
/**
 * Created by jkhaled.
 */

namespace Mystifly\BookFlight;


class BookFlight
{
    public $SessionId;
    public $FareSourceCode;
    public $TravelerInfo;
    
    public function __construct($data)
    {
        $this->SessionId = $data['sessionId'];
        $this->FareSourceCode = $data['fareSourceCode'];
        $this->buildTravelerInfo($data);
    }


    /**
     * @param $data
     */
    public function buildTravelerInfo($data)
    {
        /*
        $bookingData = [

            'sessionId' => $sessionId,
            'fareSourceCode' => $fareSourceCode,
            'TravelerInfo' => [

                'CountryCode' => 'DZ',
                'AreaCode' => '1254',
                'Email' => 'khaled.hadj.a@gmail.com',
                'PhoneNumber' => '0551469645',

                'AirTravelers' => [
                    [
                        'DateOfBirth'=>'1986-05-18',
                        'Gender'=>'M',
                        'PassengerType'=>'ADT',

                        'PassengerName' => [
                            'PassengerTitle' => 'Mr',
                            'PassengerFirstName' => 'HADJ',
                            'PassengerLastName' => 'KHALED',
                        ],
                        'Passport' => [
                            'PassportNumber' => '1224712',
                            'ExpiryDate' => '2020-11-12',
                            'Country' => 'DZ',
                        ]
                    ]
                ]
            ]
        ];
        */
        $this->TravelerInfo = new TravelerInfo($data['TravelerInfo']);
        return $this;
    }

}