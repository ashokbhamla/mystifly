<?php
/**
 * Created by  jkhaled.
 */


require_once 'vendor/autoload.php';

/**
 * create session
 */
$sessionId = (new \Mystifly\Session\CreateSession())->getSessionId();


/**
 * Flight search
 */

$data = [
    'sessionId' => $sessionId,
    'routes' => [
        [
            'OriginLocationCode' => 'ATL',
            'DestinationLocationCode' => 'ORD',
            'DepartureDateTime' => '2016-06-06',
        ]
    ],
    'passengers' => [
        [
            'type' => 'ADT',
            'quantity' => 1,
        ]
    ],
    'travelers_preferences' => [
        'MaxStopsQuantity' => 'OneStop',
        'CabinPreference' => 'Y',
        'AirTripType' => 'OneWay',
    ],
    'isRefundable' => false,
];


$fareSearch = new Mystifly\FareSearch\AirLowFareSearch();
$fareSearch->setOriginDestinationInformations($data['routes']);
$fareSearch->setPassengers($data['passengers']);
$fareSearch->setTravelPreferences($data['travelers_preferences']);
$fareSearch->setSessionId($data['sessionId']);

try {
    $flightResult = $fareSearch->getResult();
} catch (Exception $e) {
    $request = $fareSearch->getRequest();
    file_put_contents(__DIR__ . '/data/req.xml', $request);
    print($e->getMessage());
}

$listFlight = $fareSearch->getListFlight();
if(!$listFlight){
   throw new Exception('there is no flights at this dates');
}
$chosenFlight = $listFlight[0];
$fareSourceCode = $chosenFlight->AirItineraryPricingInfo->FareSourceCode;

/**
 * Revalidate
 */
$revalidate = new \Mystifly\FareSearch\AirRevalidate($sessionId, $fareSourceCode);
$validatedFlight = $revalidate->getResult();

/**
 * Rules
 */
$airRules = new \Mystifly\FareSearch\AirRule($sessionId, $fareSourceCode);


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

$travelerInfo = new Mystifly\BookFlight\BookFlight($bookingData);
$v = 1;




